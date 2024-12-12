<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
use App\Models\Product;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Date;
use MoonShine\Fields\Select;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Sales>
 */
class SalesResource extends ModelResource
{
    protected string $model = Sales::class;

    protected string $title = 'Sales';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(), // ID for the sale, sortable
                Select::make('Product', 'product_id')
                    ->options(Product::all()->pluck('name', 'id')->toArray()) // Loading products from the "productos" table
                    ->sortable(),
                Number::make('Quantity', 'quantity')->sortable(),
                Number::make('Total', 'total')->sortable(), // Total with 2 decimal places
                Date::make('Date', 'date')->sortable(),
                Select::make('Payment Method', 'payment_method')
                    ->options([
                        'efectivo' => 'Cash',
                        'tarjeta' => 'Card',
                        'transferencia' => 'Transfer',
                    ])
                    ->sortable(),
            ]),
        ];
    }

    /**
     * @param Sales $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer',
            'total' => 'required|numeric',
            'date' => 'required|date',
            'payment_method' => 'required|string|in:efectivo,tarjeta,transferencia',
        ];
    }
}