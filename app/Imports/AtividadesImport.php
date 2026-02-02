<?php

namespace App\Imports;

use App\Models\Atividade;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AtividadesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /* 
           Expected Headers (Slugged by Laravel Excel):
           status, prioridade, data_de_inicio, prazo, solicitante, 
           tipo_da_tarefa, descricao, horario, data_da_conclusao, concluida
        */
        
        // Priority mapping
        $prioRaw = strtolower(trim($row['prioridade'] ?? ''));
        $prioridade = match($prioRaw) {
            'alta' => 1,
            'média', 'media' => 2,
            'baixa' => 3,
            default => 2
        };

        // Status mapping
        $statusRaw = trim($row['status'] ?? 'Pendente');
        $concluidaCheck = trim($row['concluida'] ?? '');
        
        $status = $statusRaw;
        if ($concluidaCheck === '✅' || strtolower($statusRaw) === 'concluída' || strtolower($statusRaw) === 'concluida') {
            $status = 'Concluída';
        } elseif (strtolower($statusRaw) === 'em andamento') {
            $status = 'Em Andamento';
        }

        // Date handling
        $dataInicio = $this->parseDate($row['data_de_inicio'] ?? null);
        $dataConclusao = $this->parseDate($row['data_da_conclusao'] ?? null);

        // Title Mapping
        $titulo = $row['tipo_da_tarefa'] ?? ($row['descricao'] ?? 'Atividade Importada');
        
        // Handling potentially duplicate description columns
        $descricao = $row['descricao'] ?? '';
        if (!empty($row['descricao_2'])) {
            $descricao .= "\n\n" . $row['descricao_2'];
        }

        return new Atividade([
            'titulo'         => $titulo,
            'descricao'      => $descricao,
            'data_atividade' => $dataInicio ?? now(),
            'data_conclusao' => $dataConclusao,
            'status'         => $status,
            'prioridade'     => $prioridade,
            'responsavel'    => null,
            'solicitante'    => $row['solicitante'] ?? null,
        ]);
    }

    private function parseDate($date)
    {
        if (!$date || $date === '-') return null;
        
        try {
            if (is_numeric($date)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
            }
            // Try different formats to be safe
            if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
                return Carbon::createFromFormat('d/m/Y', $date);
            }
            return Carbon::parse($date);
        } catch (\Exception $e) {
            return null;
        }
    }
}
