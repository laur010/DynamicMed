<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('check_date'))
{
  function check_date($date)
  {

    $re1 = '((?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[0-2]?\\d{1})|(?:[3][01]{1})))(?![\\d])';	# MMDDYYYY 1

    if ($c = preg_match_all ("/".$re1."/is", $date, $matches))
    {
      $str_date = new DateTime($date);
      $str_current_date = new DateTime();
      if ($str_date > $str_current_date) {

        return false;
      }
      return true;
    }
    return false;

  }
}
if (!function_exists('get_date'))
{
  function get_date($date)
  {

    $date = explode('-', $date);
    if (count($date) != 2) {
      return '';
    }
    $date_1 = explode(' ', $date[0]);

    if (count($date_1) != 5) {
      return '';
    }
    $year = $date_1[3];
    $month = date_parse($date_1[2])['month'];
    $day = $date_1[1];
    $date_2 = $date[1].":00";

    $result = $year."-".$month."-".$day." ".$date_2;

    return $result;

  }
}
if (!function_exists('get_analysis_array'))
{
  function get_analysis_array()
  {

    $analysis_json = array(
      array('label' => 'Eritrocite, RBC', 'id' => 'eritrocite_analysis', 'man_value' => '4,3-5,9', 'woman_value' => '3,5-5,5', 'unit' => 'mil/mm<sup>2</sup>'),
      array('label' => 'VSH', 'id' => 'vsh_analysis', 'man_value' => '0-15', 'woman_value' => '0-20', 'unit' => 'mm/oră'),
      array('label' => 'Hematocrit(HT)', 'id' => 'hematocrit_analysis', 'man_value' => '41-53', 'woman_value' => '36-46', 'unit' => '%'),
      array('label' => 'Hemoglobina(Hb)', 'id' => 'hemoglobina_analysis', 'man_value' => '13,5-17,5', 'woman_value' => '12-16', 'unit' => 'g/dl'),
      array('label' => 'Reticulocite', 'id' => 'reticulocite_analysis', 'man_value' => '0,5-1,5', 'woman_value' => '0,5-1,5', 'unit' => '%'),
      array('label' => 'Leucocite, WBC', 'id' => 'leucocite_analysis', 'man_value' => '4500-11000', 'woman_value' => '4500-11000', 'unit' => 'mm<sup>-3</sup>'),
      array('label' => 'Neutrofile', 'id' => 'neutrofile_analysis', 'man_value' => '54-62', 'woman_value' => '54-62', 'unit' => '%'),
      array('label' => 'Enzinofile', 'id' => 'enzinofile_analysis', 'man_value' => '1-3', 'woman_value' => '1-3', 'unit' => '%'),
      array('label' => 'Bazofile', 'id' => 'bazofile_analysis', 'man_value' => '0-1', 'woman_value' => '0-1', 'unit' => '%'),
      array('label' => 'Limfocite', 'id' => 'limfocite_analysis', 'man_value' => '25-33', 'woman_value' => '25-33', 'unit' => '%'),
      array('label' => 'Monocite', 'id' => 'monocite_analysis', 'man_value' => '3-7', 'woman_value' => '3-7', 'unit' => '%'),
      array('label' => 'MCH', 'id' => 'mch_analysis', 'man_value' => '25,4-34,6', 'woman_value' => '25,4-34,6', 'unit' => 'pg/celulă'),
      array('label' => 'MCHC', 'id' => 'mchc_analysis', 'man_value' => '31-36', 'woman_value' => '31-36', 'unit' => '% Hb/celula'),
      array('label' => 'MCV', 'id' => 'mcv_analysis', 'man_value' => '80-100', 'woman_value' => '80-100', 'unit' => 'fl'),
      array('label' => 'APTT', 'id' => 'aptt_analysis', 'man_value' => '25-40', 'woman_value' => '25-40', 'unit' => 'sec'),
      array('label' => 'Trombocite, PLT', 'id' => 'trombocite_analysis', 'man_value' => '150000-400000', 'woman_value' => '150000-400000', 'unit' => 'mm<sup>-3</sup>'),
      array('label' => 'PT', 'id' => 'pt_analysis', 'man_value' => '11-15', 'woman_value' => '11-15', 'unit' => 'sec'),
      array('label' => 'INR', 'id' => 'inr_analysis', 'man_value' => '0,8-1,2', 'woman_value' => '0,8-1,2', 'unit' => ''),
      array('label' => 'HbA1c', 'id' => 'hba1c_analysis', 'man_value' => '0-6', 'woman_value' => '0-6', 'unit' => '%'),
      array('label' => 'AST/GOT', 'id' => 'ast_got_analysis', 'man_value' => '8-40', 'woman_value' => '8-40', 'unit' => 'U/l'),
      array('label' => 'ALT/GPT', 'id' => 'alt_gpt_analysis', 'man_value' => '8-40', 'woman_value' => '8-40', 'unit' => 'U/l'),
      array('label' => 'Amilaza serică', 'id' => 'amilaza_serica_analysis', 'man_value' => '25-125', 'woman_value' => '25-125', 'unit' => 'U/l'),
      array('label' => 'Bilirubina totală', 'id' => 'bilirubina_totala_analysis', 'man_value' => '0,1-1', 'woman_value' => '0,1-1', 'unit' => 'mg/dl'),
      array('label' => 'Bilirubina directă', 'id' => 'bilirubina_directa_analysis', 'man_value' => '0-0,3', 'woman_value' => '0-0,3', 'unit' => 'mg/dl'),
      array('label' => 'Calciu seric total', 'id' => 'calciu_seric_analysis', 'man_value' => '8,4-10,2', 'woman_value' => '8,4-10,2', 'unit' => 'mg/dl'),
      array('label' => 'Colesterol seric total', 'id' => 'colesterol_analysis', 'man_value' => '0-200', 'woman_value' => '0-200', 'unit' => 'mg/dl'),
      array('label' => 'CK', 'id' => 'ck_analysis', 'man_value' => '25-90', 'woman_value' => '10-70', 'unit' => 'U/l'),
      array('label' => 'Creatinina serică', 'id' => 'creatinina_serica_analysis', 'man_value' => '0,6-1,2', 'woman_value' => '0,6-1,2', 'unit' => 'mg/dl'),
      array('label' => 'Feritina serică', 'id' => 'feritina_serica_analysis', 'man_value' => '15-200', 'woman_value' => '12-150', 'unit' => 'ng/ml'),
      array('label' => 'FSH', 'id' => 'fsh_analysis', 'man_value' => '4-25', 'woman_value' => '4-30', 'unit' => 'mU/ml'),
      array('label' => 'Fosfataza alcalină', 'id' => 'fosfataza_alcalina_analysis', 'man_value' => '20-70', 'woman_value' => '20-70', 'unit' => 'U/l'),
      array('label' => 'Fier seric', 'id' => 'fier_seric_analysis', 'man_value' => '50-170', 'woman_value' => '50-170', 'unit' => 'μg/dl'),
      array('label' => 'Glucoză serică', 'id' => 'glucoza_serica_analysis', 'man_value' => '70-100', 'woman_value' => '70-100', 'unit' => 'mg/dl'),
      array('label' => 'LH', 'id' => 'lh_analysis', 'man_value' => '6-23', 'woman_value' => '5-30', 'unit' => 'mU/ml'),
      array('label' => 'Osmolaritatea serică', 'id' => 'osmolaritate_serica_analysis', 'man_value' => '275-295', 'woman_value' => '275-295', 'unit' => 'mosm/kg'),
      array('label' => 'PTH seric', 'id' => 'pth_seric_analysis', 'man_value' => '230-630', 'woman_value' => '230-630', 'unit' => 'pg/ml'),
      array('label' => 'Prolactina', 'id' => 'prolactina_analysis', 'man_value' => '0-20', 'woman_value' => '0-20', 'unit' => 'ng/ml'),
      array('label' => 'Proteine serice totale', 'id' => 'proteina_serica_analysis', 'man_value' => '6-7,8', 'woman_value' => '6-7,8', 'unit' => 'g/dl'),
      array('label' => 'Albumină', 'id' => 'albumina_analysis', 'man_value' => '3,5-5,5', 'woman_value' => '3,5-5,5', 'unit' => 'g/dl'),
      array('label' => 'Globuline', 'id' => 'globulina_analysis', 'man_value' => '2,3-3,5', 'woman_value' => '2,3-3,5', 'unit' => 'g/dl'),
      array('label' => 'Trigliceride', 'id' => 'triglicerida_analysis', 'man_value' => '35-160', 'woman_value' => '35-160', 'unit' => 'mg/dl'),
      array('label' => 'Uree serică', 'id' => 'uree_serica_analysis', 'man_value' => '20-50', 'woman_value' => '20-50', 'unit' => 'mg/dl'),
      array('label' => 'TSH', 'id' => 'tsh_analysis', 'man_value' => '0,5-5', 'woman_value' => '0,5-5', 'unit' => 'μU/ml'),
      array('label' => 'T4', 'id' => 't4_analysis', 'man_value' => '5-12', 'woman_value' => '5-12', 'unit' => 'μg/dl'),
      array('label' => 'T3', 'id' => 't3_analysis', 'man_value' => '115-190', 'woman_value' => '115-190', 'unit' => 'ng/dl'),
      array('label' => 'Na', 'id' => 'na_analysis', 'man_value' => '135-145', 'woman_value' => '135-145', 'unit' => 'mEq/l'),
      array('label' => 'Cl', 'id' => 'cl_analysis', 'man_value' => '95-105', 'woman_value' => '95-105', 'unit' => 'mEq/l'),
      array('label' => 'K', 'id' => 'k_analysis', 'man_value' => '3,5-5', 'woman_value' => '3,5-5', 'unit' => 'mEq/l'),
      array('label' => 'HCO<sub>3</sub>', 'id' => '_analysis', 'man_value' => '22-28', 'woman_value' => '22-28', 'unit' => 'mEq/l'),
      array('label' => 'Mg', 'id' => 'mg_analysis', 'man_value' => '1,5-2', 'woman_value' => '1,5-2', 'unit' => 'mEq/l'),
      array('label' => 'P', 'id' => 'p_analysis', 'man_value' => '3-4,5', 'woman_value' => '3-4,5', 'unit' => 'mg/dl'),
      array('label' => 'pH', 'id' => 'ph_analysis', 'man_value' => '7,35-7,55', 'woman_value' => '7,35-7,55', 'unit' => ''),
      array('label' => 'PaCO<sub>2</sub>', 'id' => 'paco_analysis', 'man_value' => '33-45', 'woman_value' => '33-45', 'unit' => 'mmHg'),
      array('label' => 'PaO<sub>2</sub>', 'id' => 'pao_analysis', 'man_value' => '75-100', 'woman_value' => '75-100', 'unit' => 'mmHg'),
      array('label' => 'IgA ser', 'id' => 'iga_analysis', 'man_value' => '76-390', 'woman_value' => '76-390', 'unit' => 'mg/dl'),
      array('label' => 'IgE ser', 'id' => 'ige_analysis', 'man_value' => '0-380', 'woman_value' => '0-380', 'unit' => 'UI/ml'),
      array('label' => 'IgG ser', 'id' => 'igg_analysis', 'man_value' => '650-1500', 'woman_value' => '650-1500', 'unit' => 'mg/dl'),
      array('label' => 'IgM ser', 'id' => 'igm_analysis', 'man_value' => '40-345', 'woman_value' => '40-345', 'unit' => 'mg/dl'),
      array('label' => 'Volum urina / 24 ore', 'id' => 'volum_urina_analysis', 'man_value' => '1-1,6', 'woman_value' => '1-1,6', 'unit' => 'l'),
      array('label' => 'Calciu', 'id' => 'calciu_analysis', 'man_value' => '100-300', 'woman_value' => '100-300', 'unit' => 'mg/24 ore'),
      array('label' => 'Clearance-ul creatinei', 'id' => 'clearance_creatina_analysis', 'man_value' => '97-137', 'woman_value' => '88-128', 'unit' => 'ml/min'),
      array('label' => '17-hidroxicorticosteroizi', 'id' => '17_hidro_analysis', 'man_value' => '3-10', 'woman_value' => '2-8', 'unit' => 'mg/24 ore'),
      array('label' => '17-cetosteroizi', 'id' => '17_cetosteroizi_analysis', 'man_value' => '8-20', 'woman_value' => '6-15', 'unit' => 'mg/24 ore'),
      array('label' => 'Osmolaritate', 'id' => 'osmolaritate_analysis', 'man_value' => '50-1400', 'woman_value' => '50-1400', 'unit' => 'mosm/kg'),
      array('label' => 'Oxalat', 'id' => 'oxalat_analysis', 'man_value' => '8-40', 'woman_value' => '8-40', 'unit' => 'μg/ml'),
      array('label' => 'Proteine', 'id' => 'proteina_analysis', 'man_value' => '0-150', 'woman_value' => '0-150', 'unit' => 'mg/24 ore'),
      array('label' => 'Urocultura', 'id' => 'urocultura_analysis', 'man_value' => '0-10000', 'woman_value' => '0-10000', 'unit' => 'UFC/ml')
    );

    return $analysis_json;

  }
}
