<?php

    namespace app\models\forms;

    use app\models\Commission;
    use yii\base\Model;
    use yii\db\ActiveRecord;

    class CommissionForm extends ActiveRecord{

        public $idRegion;
        public $idGhost;
        public $stockCategoryId;
        public $percentRegion;
        public $fixedRegion;
        public $freeRegion;
        public $percentGhost;
        public $fixedGhost;
        public $freeGhost;

        public function rules(){
            return [
                [['stockCategoryId'], 'valid_type_category'],
            ];
        }

        public function scenarios(){
            return [
                'default' => [
                    'idRegion',
                    'idGhost',
                    'stockCategoryId',
                    'percentRegion',
                    'fixedRegion',
                    'freeRegion',
                    'percentGhost',
                    'fixedGhost',
                    'freeGhost',
                ]
            ];
        }

        /**
         * @return bool
         */
        public function saveCommissions($insert){
            $bool = true;
            $models = Commission::find()
                                ->where(['stockCategoryId' => $this->stockCategoryId]);
            if(!$insert && $models->count() > 0){

                /** @var Commission $modelRegion */
                $modelRegion = $models->where(['cityType' => 'REGION'])
                                      ->one();
                $modelRegion->fixed = $this->fixedRegion;
                $modelRegion->percent = $this->percentRegion;
                $modelRegion->free = $this->freeRegion;
                $modelRegion->stockCategoryId = $this->stockCategoryId;

                /** @var Commission $modelGhost */
                $modelGhost = $models->where(['cityType' => 'GHOST'])
                                     ->one();
                $modelGhost->fixed = $this->fixedGhost;
                $modelGhost->percent = $this->percentGhost;
                $modelGhost->free = $this->freeGhost;
                $modelGhost->stockCategoryId = $this->stockCategoryId;
            }else{
                $modelRegion = is_null($this->idRegion) ? new Commission() : Commission::findOne($this->idRegion);
                $modelRegion->cityType = 'REGION';
                $modelRegion->fixed = $this->fixedRegion;
                $modelRegion->percent = $this->percentRegion;
                $modelRegion->free = $this->freeRegion;
                $modelRegion->stockCategoryId = $this->stockCategoryId;

                $modelGhost = is_null($this->idGhost) ? new Commission() : Commission::findOne($this->idGhost);
                $modelGhost->cityType = 'GHOST';
                $modelGhost->fixed = $this->fixedGhost;
                $modelGhost->percent = $this->percentGhost;
                $modelGhost->free = $this->freeGhost;
                $modelGhost->stockCategoryId = $this->stockCategoryId;

                if($modelRegion->stockCategoryId != $modelRegion->getOldAttribute('stockCategoryId') || $modelGhost->stockCategoryId != $modelGhost->getOldAttribute('stockCategoryId')){
                    $bool = $this->validate();
                }
            }

            return $bool && $modelRegion->save() && $modelGhost->save();
        }

        public static function getModels($catId){
            $form = new CommissionForm();
            $models = Commission::find()
                                ->where(['stockCategoryId' => $catId]);
            if($models->count() > 0){
                /** @var Commission $modelRegion */
                $modelRegion = $models->where(['cityType' => 'REGION'])
                                      ->one();
                $form->stockCategoryId = $modelRegion->stockCategoryId;
                $form->idRegion = $modelRegion->id;
                $form->percentRegion = $modelRegion->percent;
                $form->fixedRegion = $modelRegion->fixed;
                $form->freeRegion = $modelRegion->free;

                /** @var Commission $modelGhost */
                $modelGhost = $models->where(['cityType' => 'GHOST'])
                                     ->one();
                $form->idGhost = $modelGhost->id;
                $form->percentGhost = $modelGhost->percent;
                $form->fixedGhost = $modelGhost->fixed;
                $form->freeGhost = $modelGhost->free;
            }else{
                $modelRegion = new Commission();
                $modelRegion->cityType = 'REGION';
                $modelGhost = new Commission();
                $modelGhost->cityType = 'GHOST';
            }

            return $form;
        }

        public function valid_type_category($attribute){
            $model = Commission::find()
                               ->andWhere(['stockCategoryId' => $this->stockCategoryId])
                               ->all();
            if($model){
                $this->addError($attribute, 'уже есть такая категория');
            }
        }
    }