<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-02-04 14:28:45 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2020-02-04 14:30:22
 */


namespace app\components;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{

    public $headerOptions = [
        'class' => 'action-column',
        'style' => 'min-width: 140px; text-align: center;'
    ];

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'zoom-in-outline');
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        $class = 'btn btn-info btn-sm btn-icon';
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $class = 'btn btn-warning btn-sm btn-icon';
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        $class = 'btn btn-danger btn-sm btn-icon';
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'class' => $class,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "typcn typcn-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }

}