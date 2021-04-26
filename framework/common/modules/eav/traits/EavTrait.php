<?php

namespace common\modules\eav\traits;


use common\models\products\Products;
use common\modules\eav\models\EavAttributeType;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class EavTrait
{
    /**
     * @return string
     */
    public static function typeButtons()
    {
        $model = EavAttributeType::find()->asArray()->all();
        $buttons = '';
        foreach ($model as $item) {
            $href = Url::to(['/eav/index/create', 'type' => $item['name']]);
            $name = Yii::t('eav', $item['name']);
            $buttons .= "<a href='{$href}' class='btn btn-success btn-sm'>{$name}</a>";
        }
        return $buttons;
    }

    /**
     * @return array
     */
    public static function eavToProduct()
    {
        $model = new Products();
        return $model ? ArrayHelper::map($model->getEavAttributes()->all(), 'id', 'label') : [];
    }

    /**
     * @param array $item
     * @return string
     */
    public static function fieldText(array $item = [], $rules = null)
    { 
        $minlength = $rules['rules']['minlength'] ? "minlength='{$rules['rules']['minlength']}'" : null;
        $maxlength = $rules['rules']['maxlength'] ? "maxlength='{$rules['rules']['maxlength']}'" : null;
        return "<input 
            type='text' 
            class='form-control' 
            name='{$item['name']}' 
            placeholder='{$item['label']}'
            {$maxlength}
            {$minlength}
        >
        ";
    }

    /**
     * @param array $item
     * @return string
     */
    public static function fieldOption(array $item = [], $rules = null)
    {
        $required = $rules['required'] ? 'required' : null;

        $fields  = '<div class="form-group">';
        $fields .= "<select class='form-control dropdown-select btn-block' name='{$item['name']}' {$required}>";

        if(!empty($rules['rules']['include_blank_option'])) {
            $fields .= "<option value>-- Выбрать ".mb_strtolower($item['label'])." --</option>";
        }

        foreach ($item['eavOptions'] as $option) {
            $fields .= "<option value='{$option['id']}'>{$option['value']}</option>";
        }
        $fields .= "</select></div>";
        return $fields;
    }

    /**
     * @param array $item
     * @return string
     */
    public static function fieldRadio(array $item = [], $rules = null)
    {
        $fields = '';
        foreach ($item['eavOptions'] as $radio) {
            $isCheked = $radio['defaultOptionId'] ? 'checked' : null;
            $required = $rules['required'] ? 'required' : null;
            $disable  = $rules['locked'] ? 'disabled' : null;
            $fields .= " 
                <div class='form-check'>
                    <input 
                        class='form-check-input'
                        type='radio' 
                        name='{$item['name']}' 
                        id='{$radio['id']}' 
                        value='{$radio['id']}' 
                        {$isCheked}
                        {$disable} 
                        {$required}>
                    <label class='form-check-label' for='{$radio['id']}'>
                        {$radio['value']}
                    </label>
                </div> 
            ";
        }
        return $fields;
    }

    /**
     * @param array $item
     * @return string
     */
    public static function fieldCheckbox(array $item = [], $rules = null)
    {
        $fields = '';
        foreach ($item['eavOptions'] as $checkbox) {
            $isCheked = $checkbox['defaultOptionId'] ? 'checked' : null;
            $required = $rules['required'] ? 'required' : null;
            $disable  = $rules['locked'] ? 'disabled' : null;
            $fields .= " 
                <div class='form-check'>
                    <input 
                        class='form-check-input' 
                        type='checkbox' 
                        name='{$item['name']}[]' 
                        id='{$checkbox['id']}' 
                        value='{$checkbox['id']}' 
                        {$isCheked} 
                        {$disable} >
                    <label class='form-check-label' for='{$checkbox['id']}'>
                        {$checkbox['value']}
                    </label>
                </div> 
            ";
        }
        return $fields;
    }

    /**
     * @param Products $productModule
     * @param string $formName
     * @return string|null
     */
    public static function getEav(Products $productModule, $formName = '')
    {
        $model = $productModule->getProductAttributes()->asArray()->all();
        if(!$model) return null;
        $fields = '';
        foreach ($model as $key => $item) {
            $fieldName = 'field'.ucfirst($item['eavType']['name']);
            if(!method_exists(self::class, $fieldName)) continue;

            $rules = $item['attributeRule'];
            $rules['rules'] = json_decode($item['attributeRule']['rules'], true);

            $visible  = empty($rules['visible']) ? 'd-none' : null;

            $fields .= "<div class='eav-box mb-3 {$visible}'>";
            $fields .= "<h6 class='font-size-14'>{$item['label']}</h6>";
            $fields .= self::$fieldName($item, $rules);
            $fields .= "</div>";
        }
        return  $fields;
    }

}