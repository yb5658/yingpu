<?php
/**
 * seo方法未完成
 * @param   string
 * @return  string
 */
function seo() {

    return '';
}
// 微信日志
function addWeixinLog($data = '') {
    $log =  '====' . date( 'Y-m-d H:i:s') . '====' . PHP_EOL;
    $log .= $data . PHP_EOL . PHP_EOL;
    file_put_contents('weixin.log', $log, FILE_APPEND);
}
/**
 * 获取图片
 * @param
 * @return  string
 */
function thumb($img = '', $width = 0, $height = 0) {
    if (empty($img)) {
        return __ROOT__ . '/default.jpg';
    }
    $Uploads = '/Uploads/';
    $file = '.' . $Uploads . $img;
    if (file_exists($file)) {
        if (empty($width)) {
            return __ROOT__ . substr($file, 1);
        } else {
            $pathinfo = pathinfo($file);
            $thumb_file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $width . '-' . $height . '.' . $pathinfo['extension'];
            if (file_exists($thumb_file)) {
                return __ROOT__ . substr($thumb_file, 1);
            } else {
                $image = new \Think\Image();
                $image->open($file);
                if (empty($height)) {
                    $height = $image->height();
                }
                $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_CENTER)->save($thumb_file);
                return __ROOT__ . substr($thumb_file, 1);
            }
        }
    }
    return __ROOT__ . '/default.jpg';
}

/**
 * 获取内容信息
 * @param   string       $content  内容
 * @return  string
 */
function get_content($content = ''){
    if ($content) {
        //return preg_replace('/src="(.*?)"/', 'src="'.__ROOT__.'$1"', html_entity_decode($content));
        return html_entity_decode($content);
    } else {
        return '';
    }
}

/**
 * 获取单页内容
 * @param  int  $catid
 * @return  string
 */
function get_page($catid = 0){
    if ($catid) {
        return M('Pages')->where(array('catid'=>$catid))->getField('content');
    } else {
        return '';
    }
}

/**
 * 获取子栏目id
 * @param  [type] $catid [description]
 * @return [type]        [description]
 */
function get_childs($catid, $field = ','){
	$cates = get_category($catid);
	if ($cates) {
		$str = '';
        $i =1;
		foreach($cates as $key => $val){
			$str .= $key;
            $temp = get_childs($key, $field);
            if ($temp) {
                $str .= $field . $temp;
            }
            if (count($cates) != $i) {
                $str .= $field;
            }
            $i++;
		}
		return $str;
	} else {
		return '';
	}
}

/**
 * 获取子栏目id
 * @param  [type] $catid [description]
 * @return [type]        [description]
 */
function get_childs_array($catid){
	$cates = get_category($catid);
	if ($cates) {
		$array = array();
		foreach($cates as $key => $val){
            array_push($array, $key);
            foreach (get_childs_array($key) as $v) {
                array_push($array, $v);
            }
		}
		return $array;
	} else {
		return array();
	}
}

/**
 * 获取父级栏目
 * @param   int       $catid  栏目catid
 * @return  array
 */
function get_category($catid = 0, $num = 0) {
    $data = array();
    foreach ( D('Category')->getAll() as $key => $val) {
        if ($val['pid'] == $catid && $val['display']) {
            $data[$key] = $val;
            if ($num && count($data) >= $num) {
                break;
            }
        }
    }
    return $data;
}

/**
 * 获取广告位
 * @param   int         $id   广告位id
 * @param   int/string  $limit   数量
 * @return  array
 */
function get_banner($id = 0, $limit = 0){
    if (empty($id)) {
        return array();
    } else {
        $model = M('BannerData');
        $map = array();
        $map['bid'] = $id;
        if (empty($limit)) {
            $limit = '';
        }
        $lists = $model->cache(false, 60)->where($map)->order('sort desc, id desc')->limit($limit)->select();
        if ($lists) {
            return $lists;
        } else {
            return array();
        }
    }
}

/**
 * 获取推荐位信息
 * @param  string  $field [自定义的推荐位字段]
 * @param  integer $catid [栏目catid]
 * @param  string  $type  [数据类型News、Product、Sping]
 * @param  integer $limit [梳理]
 * @return array          [数组]
 */
function get_position($catid = 0,  $limit = 0, $field = 'position_1'    ){
    $model = M('News');
    $map = array(
        'status' => 1,
        $field => 1,
    );
    if ($catid) {
        $childs = get_childs_array($catid);
        if ($childs) {
            $childs[] = $catid;
            $map['catid'] = array('in', $childs);
        } else {
            $map['catid'] = $catid;
        }
    }
    if (empty($limit)) {
        $limit = '';
    }
    $lists = $model->cache(false, 60)->where($map)->order('sort desc, id desc')->limit($limit)->select();
    if ($lists) {
        foreach ($lists as $k => $v) {
            $lists[$k]['extends'] = unserialize($v['extends']);
            $lists[$k]['url'] = U('show', array('id'=>$v['id']));
        }
        return $lists;
    } else {
        return array();
    }
}

/**
 * 获取列表信息
 * @param  integer $catid [栏目catid]
 * @param  string  $type  [数据类型News、Product、Sping]
 * @param  integer $limit [梳理]
 * @return array          [数组]
 */
function get_lists($catid = 0, $limit = 0){
    $model = M('News');
    $map = array('status' => 1);
    if ($catid) {
        $childs = get_childs_array($catid);
        if ($childs) {
            $childs[] = $catid;
            $map['catid'] = array('in', $childs);
        } else {
            $map['catid'] = $catid;
        }
    }
    if (empty($limit)) {
        $limit = '';
    }
    $lists = $model->cache(false, 60)->where($map)->order('sort desc, id desc')->limit($limit)->select();
    if ($lists) {
        foreach ($lists as $k=> $v) {
            $lists[$k]['extends'] = unserialize($v['extends']);
            $lists[$k]['url'] = U('show', array('id'=>$v['id']));
        }
        return $lists;
    } else {
        return array();
    }
}

/**
 * 当前路径
 * 返回指定栏目路径层级
 * @param $catid 栏目id
 * @param $ext 栏目间隔符
 */
function catpos($catid = 0, $ext = '<i>></i>') {
    $categorys = D('Category')->getAll();
    $html = '';
    if ($catid == 0) {
        $html = '<a href="'. U('Index/index') .'">首页</a>' . $html;
        return $html;
    } else {
        $html = $ext . '<a href="' . $categorys[$catid]['url'] . '">' . $categorys[$catid]['title'] . '</a>' . $html;
        $html = catpos($categorys[$catid]['pid'], $ext) . $html;
    }
    return $html;
}
