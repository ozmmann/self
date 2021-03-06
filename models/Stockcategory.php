<?php
    namespace app\models;
    use Yii;
    use yii\base\Exception;
    use yii\db\ActiveRecord;
    use yii\helpers\ArrayHelper;
    use yii\helpers\BaseFileHelper;

    class Stockcategory extends ActiveRecord{

        public $parentName;
        public $children;
        public $countChild;

        public function rules(){
            return [
                ['name', 'required', 'message' => 'Поле является обязательным'],
                ['name', 'validDuplicate'],
            ];
        }

        public function scenarios(){
            return [
                'default' => ['name', 'parentId'],
            ];
        }

        public function afterFind(){
            $this->parentName = self::findOne($this->parentId)['name'];
            $this->countChild = self::find()
                                    ->where(['parentId' => $this->id])
                                    ->count();
        }

        public static function getCategoryList(){
            $categories = self::find()
                              ->asArray()
                              ->all();

            $categories = self::test($categories);

            return self::getTreeForSelect($categories);
        }


        public static function isParent($id){
            return !empty(self::findAll(['parentId' => $id]));
        }

        public static function getStructure(){
            $categories = self::find()
                              ->where(['not', ['id' => 1]])
                              ->all();
            $list = self::test($categories);
            ksort($list, SORT_NATURAL);

            return $list;
        }

        public static function test($arr, $root = null){
            $tree = null;
            for($i = 0; $i < count($arr); $i++){
                if($arr[$i]['parentId'] == $root){
                    $tree[$arr[$i]['name']] = $arr[$i];
                    $tree[$arr[$i]['name']]['children'] = self::test($arr, $arr[$i]['id']);
                }
            }

            return $tree;
        }

        public static function getTreeForSelect($list, $offset = '', &$options = []){
            if (!is_null($list)) {
                foreach ($list as $group) {
                    $parentName = Stockcategory::findOne($group['id'])->parentName;
                    $parentNameLabel = $parentName ? " ($parentName)" : '';
                    $options[$group['id']] = $offset . $group['name'] . $parentNameLabel;
                    if (!is_null($group['children'])) {
                        self::getTreeForSelect($group['children'], $offset . '- ', $options);
                    }
                }
            }

            return $options;
        }

        public function afterSave($insert, $changedAttributes){
            if($insert){
                $categoryStorage = '/web/storage/default_category_images/';
                BaseFileHelper::createDirectory(Yii::$app->basePath.$categoryStorage.$this->id);
            }
        }

        public function saveCategory(){
            if($this->validate()){
                if(is_null($this->id)){
                    $category = new Stockcategory($this->attributes);
                }else{
                    $category = Stockcategory::findOne($this->id);
                    $category->attributes = $this->attributes;
                }

                if($category->parentId === ''){
                    unset($category->parentId);
                }

                return $category->save(false);
            }

            return false;
        }

        public function validDuplicate($attribute){
            $categoryList = Stockcategory::find()
                                         ->where(['parentId' => $this->parentId])
                                         ->andWhere(['name' => $this->name])
                                         ->asArray()
                                         ->all();
            if($categoryList){
                $this->addError($attribute, "в данной категории уже есть такая запись");
            }
        }

        public static function getCategoryCovers($catId, $userId){
            $covers = [];
            $categoryStorage = '/web/storage/default_category_images/'.$catId.'/';
            try {
                if (is_dir(Yii::$app->basePath . $categoryStorage)) {
                    $defaultCategory = new \DirectoryIterator(Yii::$app->basePath . $categoryStorage);
                    foreach ($defaultCategory as $cover) {
                        if ($cover->isDot() or $cover->isDir()) {
                            continue;
                        }

                        if(strpos($cover->getFilename(), 'thumb_') !== false){
                            continue;
                        }

                        $covers[] = $categoryStorage . $cover->getFilename();
                    }
                }
            } catch (Exception $e) {
                Yii::error('Getting category folder images: ' . $e);
            }
            $userStorage = '/web/storage/users_uploads/'.$userId.'/';
            try {
                if(is_dir(Yii::$app->basePath . $userStorage)) {
                    $userCovers = new \DirectoryIterator(Yii::$app->basePath . $userStorage);
                    foreach ($userCovers as $cover) {
                        if ($cover->isDot() or $cover->isDir()) {
                            continue;
                        }

                        if(strpos($cover->getFilename(), 'thumb_') !== false){
                            continue;
                        }

                        $covers[] = $userStorage . $cover->getFilename();
                    }
                }
            } catch (Exception $e){
                Yii::error('Getting uploaded images by user: ' . $e);
            }

            return $covers;
        }

        public function delete(){
            if(!Stockcategory::isParent($this->id)){
                self::deleteAll(['id' => $this->id]);
                return true;
            }else{
                return false;
            }
        }

    }