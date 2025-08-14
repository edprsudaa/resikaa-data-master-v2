<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use \yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\RiwayatDiklat */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Tambah Medis Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-tindakan/save-medis-tindakan'],
            ]); ?>

                <div class="modal-body">
                    <div class="col-md-12">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="parent">Parent</label>
                                    <?php
                                        echo Select2::widget([
                                            'name' => 'parent',
                                            'data' =>$dataParent,
                                            'options'       => [
                                                'id'          =>'Tindakan',
                                                'placeholder' => 'Pilih Tindakan',
                                                'class'       =>'form-control-sm',
                                                'required' => true
                                            ],
                                            'pluginOptions' => [
                                                'allowClear'  => true
                                            ],
                                        ]);
                                    ?>
                                </div>   
                               
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_jenis">Kode Jenis</label>
                                    <input type="text" name="kode_jenis" id="kode_jenis" class="form-control" required></input>
                                </div> 
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                   <textarea name="deskripsi" class="form-control" id="deskripsi" rows="2" required></textarea>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="update" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
                    


