<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/10
 * Time: 16:06
 */
namespace backend\controllers;

use backend\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use backend\models\Goods;
use Yii;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;
use yii\data\Pagination;

class GoodsController extends Controller
{

    public function actionIndex()
    {
        $model = Goods::find();
        $count = $model->count();
        $pager = new Pagination(['totalCount' => $count, "pageSize" => '1']);
        $goodsList = $model->offset($pager->offset)->limit($pager->limit)->all();

        $this->layout = "layout1";
        return $this->render('index', array('goodsList' => $goodsList, 'pager' => $pager));

    }

    public function actionAdd()
    {
        $model = new Goods;
        if (Yii::$app->request->ispost) {
            $post = Yii::$app->request->post();
            //var_dump($post);die;
            $imgs = $this->upload();

            if (!$imgs) {
                $model->addError('goods_img', '商品封面不能为空');
            } else {
                $post['Goods']['goods_img'] = $imgs['goods_img'];
                $post['Goods']['album'] = $imgs['album'];
            }
//            var_dump($post);die;
            if ($imgs && $model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }

        $this->layout = "layout1";
        $catList = Category::find()->all();
        $catListArr = ArrayHelper::toArray($catList);
        $catTree = (new Category)->tree($catListArr);
        $catOpts = (new Category)->getOptions($catTree);
        unset($catOpts[0]);
        return $this->render('add', array('model' => $model, 'opts' => $catOpts));
    }

    private function upload()
    {
        if ($_FILES['Goods']['error']['goods_img'] > 0) {
            return false;
        }

        require(__DIR__ . '/../../vendor/Qiniu/functions.php');
        // 用于签名的公钥和私钥
        $accessKey = '3UqPa31k1QlsFpnPl3zIbSMb4KJh_SQy3PCXdTCp';
        $secretKey = 'mGmv7e_dm4zfr0LFF6pyljwdG97-vRKITe6Bm4u-';

        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        // 要上传的空间
        $bucket = 'images';
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();
        $key = uniqid();
        $filePath = $_FILES['Goods']['tmp_name']['goods_img'];
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            var_dump($err);
        } else {
            //var_dump($ret);
            $goods_img = $ret['key'];
        }

        //上传商品相册
        $album = array();
        foreach ($_FILES['Goods']['tmp_name']['album'] as $k => $v) {
            if ($_FILES['Goods']['error']['album'][$k]) {
                continue;
            }
            $key = uniqid();
            $filePath = $_FILES['Goods']['tmp_name']['album'][$k];
            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            $album[] = $ret['key'];
        }

        return array('goods_img' => $goods_img, 'album' => json_encode($album));

    }


    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = Goods::find()->where("goods_id = $id")->one();

        if (Yii::$app->request->ispost) {
            $post = Yii::$app->request->post();
            $imgs = $this->upload();

            if (!$imgs) {
                $model->addError('goods_img', '商品封面不能为空');
            } else {
                $post['Goods']['goods_img'] = $imgs['goods_img'];
                $post['Goods']['album'] = $imgs['album'];
            }
//            var_dump($post);die;
            if ($imgs && $model->edit($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
                $this->redirect(['goods/index']);
            } else {
                Yii::$app->session->setFlash('info', '修改失败');
            }
        }

        $this->layout = "layout1";
        $catList = Category::find()->all();
        $catListArr = ArrayHelper::toArray($catList);
        $catTree = (new Category)->tree($catListArr);
        $catOpts = (new Category)->getOptions($catTree);
        unset($catOpts[0]);
        return $this->render('add', array('model' => $model, 'opts' => $catOpts));
    }


    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $goods = Goods::find()->where("goods_id = $id")->one();


        require(__DIR__ . '/../../vendor/Qiniu/functions.php');
        // 用于签名的公钥和私钥
        $accessKey = '3UqPa31k1QlsFpnPl3zIbSMb4KJh_SQy3PCXdTCp';
        $secretKey = 'mGmv7e_dm4zfr0LFF6pyljwdG97-vRKITe6Bm4u-';

        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);
        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);
        //你要测试的空间， 并且这个key在你空间中存在
        $bucket = 'images';
        $key = $goods['goods_img'];
        //删除$bucket 中的文件 $key
        $err = $bucketMgr->delete($bucket, $key);
//        if ($err !== null) {
//            var_dump($err);
//        } else {
//            echo "Success!";
//        }

        foreach(json_decode($goods['album'],true) as $k=>$v){
            $err = $bucketMgr->delete($bucket, $v);
            if ($err !== null) {
                var_dump($err);
            }
        }

        Goods::deleteAll("goods_id = $id");
        return $this->redirect(['goods/index']);

    }

}