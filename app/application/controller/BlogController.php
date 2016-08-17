<?php

class BlogController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index($params){
        if(Request::get('keyword')){
            $page = 1;
            $pages = 1;
            $posts = Post::getInstance()->byKeyword(Request::get('keyword'));
            foreach ($posts as $post) {
                $ps = explode('</p>', $post->post_content);
                $post->excerpt = $ps[0].$ps[1];
            }
        }else{
            $page = $params ? $params['page'] : 1;
            $pages = Post::getInstance()->pages();
            $posts = Post::getInstance()->byPage($page);
            foreach ($posts as $post) {
                $ps = explode('</p>', $post->post_content);
                $post->excerpt = $ps[0].$ps[1];
            }
        }
        $last = Post::getInstance()->last();
        $this->View->render('blog/index.html', array('posts'=>$posts, 'pages'=>$pages, 'page'=>$page, 'last'=>$last));
    }

    public function nota($params){
        $post = Post::getInstance()->byTag($params['tag']);
        $last = Post::getInstance()->last();
        $this->View->render('blog/detalle.html', array('post'=>$post, 'last'=>$last));
    }
}
