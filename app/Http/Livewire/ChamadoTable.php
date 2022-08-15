<?php

namespace App\Http\Livewire;

use App\Models\Chamados;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Stringable;

final class ChamadoTable extends PowerGridComponent
{
    use ActionButton;
    
    public string $sortField = '';
    public string $sortDirection = '';
    public string $setor;

    public function setUp(): array
    {
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource()
    {
        return Chamados::hydrate(DB::select(DB::raw('
        select c.id, c.solicitante solicitante,
                c.created_at aberto_em, c.status,
                concat(ca.nome, \' - \', s.nome) categoria,
                c.data_conclusao conclusao, u.name responsavel,
                c.respondido
                from chamados c
            join subcategorias s on c.subCategoria_id = s.id
            join categorias ca on s.categoria_id = ca.id
            join setores se on se.id = ca.setor_id
            left join users u on u.id = c.responsavel_id
            where se.nome = \''. $this->setor . '\'
            order by c.respondido desc, c.status asc, c.id desc
        ')));
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('status', function (Chamados $model) {
                $respondido = $model->respondido ? " (respondido)" : '';
                switch ($model->status) {
                    case 0:
                        return "Reaberto$respondido";
                        break;
                    case 1:
                        return "Aberto$respondido";
                        break;
                    case 2:
                        return "Em andamento$respondido";
                        break;
                    case 3:
                        return "Encerrado$respondido";
                        break;
                    default:
                        return $model->status;
                        break;
                }
            })
            ->addColumn('conclusao', fn (Chamados $model) => $model->conclusao ? Carbon::parse($model->data_conclusao)->format('d/m/Y H:i:s') : "")
            ->addColumn('aberto_em', function (Chamados $model) {
                return Carbon::parse($model->aberto_em)->format('d/m/Y H:i:s');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            
            Column::make('Estado', 'status')
                ->searchable()
                ->sortable(),

            Column::make('Categoria', 'categoria')
                ->searchable()
                ->makeInputText('categoria')
                ->sortable(),

            Column::make('Solicitante', 'solicitante')
                ->searchable()
                ->makeInputText('solicitante')
                ->sortable(),

            Column::make('Aberto', 'aberto_em')
                ->searchable()
                ->makeInputDatePicker(),

            Column::make('Conclusão', 'conclusao'),

            Column::make('Responsavel', 'responsavel')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Chamados Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
       return [
        //    Button::make('edit', 'Edit')
        //        ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
        //        ->route('chamados.edit', ['chamados' => 'id']),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('chamados.destroy', ['chamados' => 'id'])
        //        ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Chamados Action Rules.
     *
     * @return array<int, RuleActions>
     */

    
    public function actionRules(): array
    {
       return [
            Rule::rows()
                ->when(fn($chamados) => $chamados->status == 1)
                ->setAttribute('class', 'aberto'),
        ];
    }
    
}
