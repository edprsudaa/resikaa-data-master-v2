<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TbRiwayatPenempatan]].
 *
 * @see TbRiwayatPenempatan
 */
class RiwayatPenempatanQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere([RiwayatPenempatan::tableName().'.status_aktif'=>1]);
    }

    /**
     * {@inheritdoc}
     * @return RiwayatPenempatan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RiwayatPenempatan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }    
}
