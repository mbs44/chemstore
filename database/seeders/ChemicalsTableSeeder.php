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

        $aceticAnhydrideAcetanhydrid = Chemical::create([
            'chemical_formula' => 'C4H6O3', 'chemical_name_sk' => 'anhydrid kyseliny octovej', 'chemical_name_en' => 'Acetic Anhydride(Acetanhydrid)',
            'disposal_sk' => 'je možné recyklovať na pracovisku',
            'disposal_en' => 'can be recycled at the workplace',
            'access_sk' => 'učiteľ', 'access_en' => 'teacher',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
            ]);

        $aceticAnhydrideAcetanhydrid->dangerousProperties()->attach([$c->id]);
        $aceticAnhydrideAcetanhydrid->safetyItems()->attach([$apron->id, $gloves->id, $goggles->id,$fumeHood->id]);

        $potassiumNitrate = Chemical::create([
            'chemical_formula' => 'KNO3', 'chemical_name_sk' => 'dusičnan draselný', 'chemical_name_en' => 'Potassium nitrate',
            'disposal_sk' => 'riedenie vodou kanalizačný systém',
            'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $potassiumNitrate->dangerousProperties()->attach([$o->id]);
        $potassiumNitrate->safetyItems()->attach([ $gloves->id]);

        $silverNitrate  = Chemical::create([
            'chemical_formula' => 'AgNO3', 'chemical_name_sk' => 'dusičnan strieborný', 'chemical_name_en' => 'Silver nitrate',
            'disposal_sk' => 'je možné recyklovať na pracovisku', 'disposal_en' => 'can be recycled at the workplace',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $silverNitrate->dangerousProperties()->attach([$c->id,$n->id]);
        $silverNitrate->safetyItems()->attach([$apron->id, $gloves->id]);

        $ethylAcetate   = Chemical::create([
            'chemical_formula' => 'CH3COOCH2CH3', 'chemical_name_sk' => 'etylacetát', 'chemical_name_en' => 'Ethyl acetate',
            'disposal_sk' => '', 'disposal_en' => '',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $ethylAcetate->dangerousProperties()->attach([$f->id,$xi->id]);
        $ethylAcetate->safetyItems()->attach([$fumeHood->id, $gloves->id, $gloves->id]);

        $phenolphthalein = Chemical::create([
            'chemical_formula' => 'C20H14O4', 'chemical_name_sk' => 'fenolftaleín 1%', 'chemical_name_en' => 'phenolphthalein',
            'access_sk' => 'učiteľ/žiak iba s roztokom < 1%', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $phenolphthalein->dangerousProperties()->attach([$f->id,$xi->id]);
        $phenolphthalein->safetyItems()->attach([$fumeHood->id, $gloves->id, $gloves->id]);

        $fructose = Chemical::create([
            'chemical_formula' => 'C6H12O6', 'chemical_name_sk' => 'fruktóza', 'chemical_name_en' => 'fructose ',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $glucose  = Chemical::create([
            'chemical_formula' => 'C6H12O6', 'chemical_name_sk' => 'fruktóza', 'chemical_name_en' => 'fructose ',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $potassiumFerricyanide  = Chemical::create([
            'chemical_formula' => 'C6N6FeK3', 'chemical_name_sk' => 'hexakyanoželezitan draselný', 'chemical_name_en' => 'Potassium ferricyanide',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);


        $potassiumFerrocyanide  = Chemical::create([
            'chemical_formula' => 'K4[Fe(CN)6]', 'chemical_name_sk' => 'hexakyanoželeznatan draselný', 'chemical_name_en' => 'Potassium ferrocyanide',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $magnesium  = Chemical::create([
            'chemical_formula' => 'MgO', 'chemical_name_sk' => 'horčík', 'chemical_name_en' => 'Magnesium',
            'disposal_sk' => '', 'disposal_en' => '',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $magnesium ->dangerousProperties()->attach([$f->id]);
        $magnesium ->safetyItems()->attach([$gloves->id]);

        $bicarbonateOfSoda  = Chemical::create([
            'chemical_formula' => 'MgO', 'chemical_name_sk' => 'hydrogenuhličitan sodný', 'chemical_name_en' => 'Bicarbonate of Soda',
            'disposal_sk' => '', 'disposal_en' => '',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $bicarbonateOfSoda->dangerousProperties()->attach([$f->id]);
        $bicarbonateOfSoda ->safetyItems()->attach([$gloves->id]);

        $sodiumHydroxide = Chemical::create([
            'chemical_formula' => 'NaOH', 'chemical_name_sk' => 'hydroxid sodný', 'chemical_name_en' => 'Sodium hydroxide',
            'disposal_sk' => 'neutralizácia kanalizačný systém', 'disposal_en' => 'neutralization sewage system',
            'access_sk' => 'učitel/žiak iba s roztokom < 0,5%', 'access_en' => 'teacher/student only with solution < 0.5%)',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $sodiumHydroxide ->dangerousProperties()->attach([$c->id]);
        $sodiumHydroxide  ->safetyItems()->attach([$apron->id, $gloves->id, $fumeHood->id, $goggles->id]);

        $copperIIchloride = Chemical::create([
            'chemical_formula' => 'CuCl2', 'chemical_name_sk' => 'chlorid meďnatý', 'chemical_name_en' => 'Copper(II) chloride',
            'disposal_sk' => 'musí byť odovzdaný', 'disposal_en' => 'must be handed over',
            'access_sk' => 'učitel/žiak', 'access_en' => 'teacher/student)',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $copperIIchloride ->dangerousProperties()->attach([$n->id,$xn->id]);
        $copperIIchloride  ->safetyItems()->attach([$gloves->id,$apron->id]);

        $iodine = Chemical::create([
            'chemical_formula' => 'I', 'chemical_name_sk' => 'jód', 'chemical_name_en' => 'Iodine',
            'disposal_sk' => 'musí byť odovzdaný', 'disposal_en' => 'must be handed over',
            'access_sk' => 'učitel/žiak', 'access_en' => 'teacher/student)',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $iodine ->dangerousProperties()->attach([$n->id,$xn->id]);
        $iodine  ->safetyItems()->attach([$gloves->id,$apron->id,$fumeHood->id]);

        $potassiumIodide = Chemical::create([
            'chemical_formula' => 'KI', 'chemical_name_sk' => 'jodid draselný', 'chemical_name_en' => 'Potassium iodide',
            'disposal_sk' => '', 'disposal_en' => '',
            'access_sk' => 'učitel/žiak', 'access_en' => 'teacher/student)',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $citricAcid  = Chemical::create([
            'chemical_formula' => 'C₆H₈O₇', 'chemical_name_sk' => 'kyselina citrónová', 'chemical_name_en' => 'Iodine',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učitel/žiak', 'access_en' => 'teacher/student)',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $citricAcid ->dangerousProperties()->attach([$xi->id,$c->id]);
        $citricAcid ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id, $goggles->id]);

        $nitricAcid = Chemical::create([
            'chemical_formula' => 'HNO₃', 'chemical_name_sk' => 'kyselina dusičná', 'chemical_name_en' => 'Nitric acid',
            'disposal_sk' => 'neutralizácia riedenie vodou kanalizačný systém', 'disposal_en' => 'neutralization dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak iba s roztokom < 5%', 'access_en' => 'teacher/student only with solution < 5%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $nitricAcid ->dangerousProperties()->attach([$xi->id,$c->id]);
        $nitricAcid ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id, $goggles->id]);

        $hydrochloricAcid = Chemical::create([
            'chemical_formula' => 'HCl', 'chemical_name_sk' => 'kyselina chlorovodíková', 'chemical_name_en' => 'Hydrochloric acid',
            'disposal_sk' => 'neutralizácia riedenie vodou kanalizačný systém', 'disposal_en' => 'neutralization dilution with water sewage system',
            'access_sk' => 'učitel/žiak iba s roztokom < 10%', 'access_en' => 'teacher/student only with solution < 10%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $hydrochloricAcid ->dangerousProperties()->attach([$xi->id,$c->id]);
        $hydrochloricAcid ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id, $goggles->id]);

        $acceticAcid = Chemical::create([
            'chemical_formula' => 'CH₃COOH', 'chemical_name_sk' => 'kyselina octová', 'chemical_name_en' => 'AcceticA cid',
            'disposal_sk' => 'neutralizácia riedenie vodou kanalizačný systém', 'disposal_en' => 'neutralization dilution with water sewage system',
            'access_sk' => 'učitel/žiak iba s roztokom < 10%', 'access_en' => 'teacher/student only with solution < 10%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $acceticAcid ->dangerousProperties()->attach([$xi->id,$c->id]);
        $acceticAcid ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id, $goggles->id]);

        $sulfuricAcid = Chemical::create([
            'chemical_formula' => 'H₂SO₄', 'chemical_name_sk' => 'kyselina sírová', 'chemical_name_en' => 'Sulfuric acid',
            'disposal_sk' => 'neutralizácia riedenie vodou kanalizačný systém', 'disposal_en' => 'neutralization dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak iba s roztokom < 5% ', 'access_en' => 'teacher/student only with solution < 5%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $sulfuricAcid ->dangerousProperties()->attach([$c->id]);
        $sulfuricAcid ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id, $goggles->id]);

        $litmus  = Chemical::create([
            'chemical_formula' => 'chemical composition C9H10O5N and C13H22O6, for blue and red litmus papers respectively', 'chemical_name_sk' => 'lakmus', 'chemical_name_en' => 'Litmus',
            'disposal_sk' => 'neutralizácia riedenie vodou kanalizačný systém', 'disposal_en' => 'neutralization dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);
        $potassiumPermanganate = Chemical::create([
            'chemical_formula' => 'KMnO₄', 'chemical_name_sk' => 'manganistan draselný', 'chemical_name_en' => 'Sulfuric acid',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $potassiumPermanganate ->dangerousProperties()->attach([$o->id,$n->id,$c->id]);
        $potassiumPermanganate ->safetyItems()->attach([$gloves->id,$apron->id]);

        $methylOrange = Chemical::create([
            'chemical_formula' => 'C14H14N3NaO3S', 'chemical_name_sk' => 'metyloranž', 'chemical_name_en' => 'Sulfuric acid',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $methylOrange ->dangerousProperties()->attach([$t->id]);
        $methylOrange ->safetyItems()->attach([$gloves->id,$apron->id, $fumeHood->id]);

        $manganeseIVoxide = Chemical::create([
            'chemical_formula' => 'MnO₂', 'chemical_name_sk' => 'oxid manganičitý', 'chemical_name_en' => 'Manganese(IV) oxide',
            'disposal_sk' => 'surovina pre ďalšie práce', 'disposal_en' => 'raw material for further work',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $manganeseIVoxide ->dangerousProperties()->attach([$xn->id]);
        $manganeseIVoxide ->safetyItems()->attach([$gloves->id,$apron->id, $respirator->id]);

        $hydrogenPeroxide = Chemical::create([
            'chemical_formula' => 'H2O2', 'chemical_name_sk' => 'peroxid vodíka', 'chemical_name_en' => 'Hydrogen peroxide',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak iba s roztokom < 5% ', 'access_en' => 'teacher/student only with solution < 5%',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);

        $hydrogenPeroxide ->dangerousProperties()->attach([$xn->id,$c->id]);
        $hydrogenPeroxide ->safetyItems()->attach([$gloves->id,$apron->id, $respirator->id]);

        $sulfur= Chemical::create([
            'chemical_formula' => 'S8', 'chemical_name_sk' => 'síra', 'chemical_name_en' => 'Sulfur',
            'disposal_sk' => 'riedenie vodou kanalizačný systém', 'disposal_en' => 'dilution with water sewage system',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $ml->id, 'supplies_id' => 1 //high
        ]);
        $sodiumSulfate = Chemical::create([
            'chemical_formula' => 'Na2SO4', 'chemical_name_sk' => 'síran meďnatý', 'chemical_name_en' => 'Sodium sulfate',
            'disposal_sk' => 'je možné recyklovať na pracovisku', 'disposal_en' => 'can be recycled at the workplace',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $sodiumSulfate ->dangerousProperties()->attach([$xn->id,$n->id]);
        $sodiumSulfate ->safetyItems()->attach([$gloves->id,$apron->id]);

        $starch = Chemical::create([
            'chemical_formula' => '(C6H10O5)n)', 'chemical_name_sk' => 'škrob', 'chemical_name_en' => 'Starch',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);

        $calciumCarbonate = Chemical::create([
            'chemical_formula' => '(CaCO3)', 'chemical_name_sk' => 'uhličitan vápenatý', 'chemical_name_en' => 'Calcium carbonate',
            'access_sk' => 'učiteľ/žiak', 'access_en' => 'teacher/student',
            'measure_unit_id' => $gram->id, 'supplies_id' => 1 //high
        ]);
    }
}
