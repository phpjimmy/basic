<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller{
       public function actionIndex(){
        $query = Country::find();
         
        //$pagination对象的使命主要有两点:1.为 SQL 查询语句设置 offset 和 limit 从句， 确保每个请求只需返回一页数据（本例中每页是 5 行）。
                                     //2.在视图中显示一个由页码列表组成的分页器， 这点将在后面的段落中解释
        /*
         *  Pagination 提供了为数据结果集分页的所有功能：
          首先 Pagination 把 SELECT 的子查询 LIMIT 5 OFFSET 0 数据表示成第一页。 因此开头的五条数据会被取出并显示。
          然后小部件 LinkPager 使用 Pagination::createUrl() 方法生成的 URL 去渲染翻页按钮。
         *  URL 中包含必要的参数 page 才能查询不同的页面编号。
           如果你点击按钮 “2”，将会发起一个路由为 country/index 的新请求。 
         * Pagination 接收到 URL 中的 page 参数把当前的页码设为 2。 新的数据库请求将会以 LIMIT 5 OFFSET 5 查询并显示。
        */
        
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
                           ->offset($pagination->offset)
                           ->limit($pagination->limit)
                           ->all();

        return $this->render('index', [
                                        'countries' => $countries,
                                        'pagination' => $pagination,
                                    ]);
    }
    
}
