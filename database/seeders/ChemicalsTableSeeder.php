<?php
// database/seeders/MeasureUnitsTableSeeder.php

namespace Database\Seeders;

use App\Models\Chemical;
use App\Models\DangerousProperty;
use App\Models\MeasureUnit;
use App\Models\SafetyItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChemicalsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Insert measure units into the measure_units table
        $gram = MeasureUnit::create(['name' => 'gram', 'isoName' => 'g' ]);
        $ml = MeasureUnit::create(['name' => 'milliliter', 'isoName' => 'ml']);

        // Insert measure units into the measure_units table
        $apron = SafetyItem::create(['name_sk' => 'Plášť', 'name_en' => 'Apron']);
        $gloves = SafetyItem::create(['name_sk' => 'Rukavice', 'name_en' => 'Gloves']);
        $goggles = SafetyItem::create(['name_sk' => 'Okuliare', 'name_en' => 'Goggles']);
        $respirator = SafetyItem::create(['name_sk' => 'Respirátor', 'name_en' => 'Respirator']);
        $fumeHood = SafetyItem::create(['name_sk' => 'Laboratórny digestor', 'name_en' => 'Fume hood']);

        $f = DangerousProperty::create(['code' => 'F', 'name_sk' => 'Ľahko horľavá', 'name_en' => 'Highly flammable',
            'description_sk' => 'Tieto látky môžu ľahko vzplanúť pri kontakte s ohňom alebo zdrojmi tepla',
            'description_en' => 'Easily ignite and catch fire in the presence of heat, sparks, or flames. They pose significant fire hazards',
        ]);
        $c = DangerousProperty::create(['code' => 'C', 'name_sk' => 'Korozívna', 'name_en' => 'Corrosive',
            'description_sk' => 'Látky označené touto skratkou spôsobujú vážne poškodenie kože a/alebo očí. Môžu tiež poškodiť kovové materiály',
            'description_en' => 'Can cause severe damage to living tissue (such as skin and eyes) and materials (like metals). These chemicals can lead to burns or permanent tissue damage',
        ]);
        $n = DangerousProperty::create(['code' => 'N', 'name_sk' => 'Nebezpečná pre životné prostredie', 'name_en' => 'Dangerous for the environment',
            'description_sk' => 'Tieto látky predstavujú nebezpečenstvo pre vodné organizmy a životné prostredie. Môžu spôsobiť dlhodobé poškodenie vodného prostredia',
            'description_en' => 'Hazardous to aquatic life and ecosystems. It can cause long-lasting effects to the environment, particularly in water bodies, and may accumulate in aquatic organisms',
        ]);
        $o = DangerousProperty::create(['code' => 'O', 'name_sk' => 'Oxidant', 'name_en' => 'Oxidizing',
            'description_sk' => 'Látky označené touto skratkou sú oxidačné, čo znamená, že môžu podporovať horenie iných materiálov tým, že uvoľňujú kyslík',
            'description_en' => 'Can cause or enhance the combustion of other materials by releasing oxygen, making them more reactive and potentially increasing fire hazards',
        ]);
        $xi = DangerousProperty::create(['code' => 'Xi', 'name_sk' => 'Dráždivá', 'name_en' => 'Irritant',
            'description_sk' => 'Látky, ktoré môžu spôsobiť dráždenie pokožky, očí alebo dýchacích ciest, ale nezpôsobujú trvalé poškodenie',
            'description_en' => 'Can cause reversible damage to eyes, skin, or respiratory tract. Prolonged or repeated exposure can cause skin dryness, irritation, or inflammation',
        ]);
        $xn = DangerousProperty::create(['code' => 'Xn', 'name_sk' => 'Škodlivá', 'name_en' => 'Harmful',
            'description_sk' => 'Škodlivá látka (harmful), tieto látky môžu spôsobiť škody na zdraví pri ich vdýchnutí, požití alebo kontakte s pokožkou, ale nie sú také nebezpečné, aby spadali pod kategóriu toxických látok',
            'description_en' => 'Harmful to health when inhaled, ingested, or absorbed through the skin. These substances may cause health effects such as irritation, organ damage, or long-term harm, but they are not classified as highly toxic',
        ]);
        $t = DangerousProperty::create(['code' => 'T', 'name_sk' => 'Toxická', 'name_en' => 'Toxic',
            'description_sk' => 'Látky označené touto skratkou môžu byť nebezpečné pri vdýchnutí, požití alebo kontakte so pokožkou. Môžu spôsobovať vážne alebo smrteľné poškodenie zdravia',
            'description_en' => 'Toxic and can cause severe health effects, even in small amounts. They may cause organ damage, or even death, if ingested, inhaled, or absorbed through the skin',
        ]);

        $aceton = Chemical::create([
            'chemical_formula' => '(CH3)2CO', 'chemical_name_sk' => 'Acetón', 'chemical_name_en' => 'Aceton',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $aceton->dangerousProperties()->attach([$f->id,$xi->id]);
        $aceton->safetyItems()->attach([$apron->id, $gloves->id, $fumeHood->id]);

        $ammonia = Chemical::create([
            'chemical_formula' => 'NH3', 'chemical_name_sk' => 'Amoniak', 'chemical_name_en' => 'Ammonia',
            'disposal_sk' => 'neutralizácia, riedenie vodou kanalizačný systém',
            'disposal_en' => 'neutralization, dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak iba s roztokom < 5%', 'access_en' => 'teacher/student only with solution < 5%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $ammonia->dangerousProperties()->attach([$c->id,$n->id]);
        $ammonia->safetyItems()->attach([$apron->id, $gloves->id, $goggles->id,$fumeHood->id]);

    }
}
