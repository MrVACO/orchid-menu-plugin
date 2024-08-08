<?php

namespace MrVaco\Orchid\Menu\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \MrVaco\Orchid\Menu\Models\Menu */
class MenuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!empty($this->children))
            $this->load('children');

        return [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'target' => $this->target,
            'children' => MenuResource::collection($this->whenLoaded('children')),
        ];
    }
}
