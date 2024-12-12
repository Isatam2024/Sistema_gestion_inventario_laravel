<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Stock_History;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Date;

/**
 * @extends ModelResource<Stock_History>
 */
class Stock_HistoryResource extends ModelResource
{
    protected string $model = Stock_History::class;

    protected string $title = 'Stock_Histories';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $DETAILInModal = false;

   

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),  // id_historial (INT)
                Number::make("Stock ID", "id_historial")->sortable(),  // id_historial
                Number::make("Product ID", "id_producto")->sortable(),  // id_producto
                Number::make("Quantity Changed", "quantity_changed")->sortable(),  // cantidad_cambiada
                Select::make("Change Type", "change_type")  // tipo_cambio (ENUM)
                    ->options([
                        'sale' => 'Sale',
                        'purchase' => 'Purchase',
                        'adjustment' => 'Adjustment'
                    ])
                    ->sortable(),
                Date::make("Date", "date")  // fecha (TIMESTAMP)
                    ->default(now())
                    ->sortable(),
            ]),
        ];
    }

    /**
     * @param Stock_History $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
