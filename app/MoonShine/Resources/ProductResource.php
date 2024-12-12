<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Text;   // Ensure you import this
use MoonShine\Fields\Number; // If not already imported
use MoonShine\Fields\ID;     // If not already imported
use MoonShine\Fields\Select; // For status, if you use "active" and "inactive"
use MoonShine\Fields\Decimal; // For price, better precision with decimals

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

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
                ID::make()->sortable(),  // ID of the product (auto-incremented)
                Text::make("Name", "name")->sortable()->required(),  // Product Name
                Text::make("Description", "description")->sortable()->required(),  // Product Description
                Number::make("Price", "price")->sortable()->required(),  // Price of the product (with decimals)
                Select::make("Status", "status")  // Status (Active / Inactive)
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive'
                    ])
                    ->required(),  
    
            ]),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],  // Name is required
            'description' => ['required', 'string'],  // Description is required
            'price' => ['required', 'numeric', 'min:0'],  // Price is required and must be a number
            'status' => ['required', 'in:0,1'], 
              // Status must be either 0 (inactive) or 1 (active)
        ];
    }
}
