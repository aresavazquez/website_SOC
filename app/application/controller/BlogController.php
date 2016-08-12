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
        $page = $params ? $params['page'] : 1;
    	$pages = Post::getInstance()->pages();
        $posts = Post::getInstance()->byPage($page);
        foreach ($posts as $post) {
            $ps = explode('</p>', $post->post_content);
            $post->excerpt = $ps[0].$ps[1];
        }
        $this->View->render('blog/index.html', array('posts'=>$posts, 'pages'=>$pages, 'page'=>$page));
    }

    public function nota($params){
        $post = Post::getInstance()->byTag($params['tag']);
        $this->View->render('blog/detalle.html', array('post'=>$post));
    }
}
