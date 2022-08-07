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

    public string $setor;
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Collection
    {
        return Chamados::hydrate(DB::select(DB::raw('
        select c.id id, c.solicitante solicitante,
                c.created_at aberto_em, c.status status,
                concat(ca.nome, \' - \', s.nome) categoria,
                c.data_conclusao conclusao, u.name responsavel
                from chamados c
            join subcategorias s on c.subCategoria_id = s.id
            join categorias ca on s.categoria_id = ca.id
            join setores se on se.id = ca.setor_id
            left join users u on u.id = c.responsavel_id
            where se.nome = \''. $this->setor . '\'
           ;
        ')));
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('status', fn (Chamados $model) => Str::title($model->status))
            ->addColumn('aberto_em', fn (Chamados $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),
            
            Column::make('Estado', 'status')
                ->searchable()
                ->sortable(),

            Column::make('Categoria', 'categoria')
                ->searchable()
                ->sortable(),

            Column::make('Solicitante', 'solicitante')
                ->searchable()
                ->makeInputText('solicitante')
                ->sortable(),

            Column::make('Aberto em', 'aberto_em'),

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
        Button::add('new-modal')
            ->caption('New window')
            ->class('bg-gray-300')
            ->openModal('new', []),
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
                ->when(fn($chamados) => $chamados->status === 'aberto')
                ->setAttribute('class', 'aberto'),
        ];
    }
    
}
