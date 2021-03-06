<?php
namespace backend\controllers;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\web\Controller;

class TestController extends Controller
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        //require '../Qiniu/functions.php'; //需要引入
        require  'vendor/Qiniu/functions.php';
    }

    public function actionIndex(){
        // 用于签名的公钥和私钥
        $accessKey = '3UqPa31k1QlsFpnPl3zIbSMb4KJh_SQy3PCXdTCp';
        $secretKey = 'mGmv7e_dm4zfr0LFF6pyljwdG97-vRKITe6Bm4u-';

        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = 'videopro';

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        //注意我们是把图片存放到`web/uploads/videos`目录下的
        $filePath = 'uploads/videos/58983a4c6799a.png';

        // 上传到七牛后保存的文件名
        $key = '58983a4c6799a.png';

        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }

        return 'test';
    }
}