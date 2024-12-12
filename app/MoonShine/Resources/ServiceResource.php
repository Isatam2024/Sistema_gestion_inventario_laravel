<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
#use Illuminate\Support\Facades\Date;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Date;  // Corrigiendo a Date para fechas

/**
 * @extends ModelResource<Service>
 */
class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $title = 'Services';

    protected bool $createInModal = true;

    protected bool $detailInModal = true;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make("ID Stock", "Id_stock")->sortable(),
                Number::make("ID Product", "Id_product")->sortable(),
                Number::make("Quantity", "quantity")->sortable(),
                Date::make("Last Update Date", "last_update_date")->sortable(),  // Corrección aquí
                Text::make("Status", "status")->sortable(),
            ]),
        ];
    }

    /**
     * @param Service $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'Id_stock' => 'required|numeric',
            'Id_product' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'last_update_date' => 'required|date',
            'status' => 'nullable|string',
        ];
    }
}
