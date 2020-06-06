<?php

namespace app\modules\metric\models;

use Yii;

/**
 * This is the model class for table "metrics".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $field
 * @property string|null $value
 * @property string|null $date
 */
class Metric extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metrics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'field', 'value'], 'required'],
            [['name', 'field', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'field' => 'Field',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }
    /** @inheritDoc */
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['id']);

        return $fields;
    }
    /** @inheritDoc */
    public function extraFields()
    {
        $fields = parent::extraFields();
        $fields['id']= 'id';

        return $fields;
    }

    /** @inheritDoc */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'field', 'value'];
        return $scenarios;
    }

    public function add()
    {
            $metric = new Metric();
            $metric->name = $this->name;
            $metric->field = $this->field;
            $metric->value = $this->value;
            $metric->date = date("Y-m-d H:i:s");
            return $metric->save();
    }
}
