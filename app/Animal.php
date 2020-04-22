<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Carbon;

/**
 * Class Animal
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property int $species_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Species newModelQuery()
 * @method static Builder|Species newQuery()
 * @method static Builder|Species query()
 * @method static Builder|Species whereCreatedAt($value)
 * @method static Builder|Species whereId($value)
 * @method static Builder|Species whereName($value)
 * @method static Builder|Species whereSlug($value)
 * @method static Builder|Species whereDescription($value)
 * @method static Builder|Species whereDomainId($value)
 * @method static Builder|Species whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Species $species
 */
class Animal extends BaseModel
{
    public function species()
    {
        return $this->belongsTo(Species::class);
    }
}
