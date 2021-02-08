<?php
namespace App\Libraries;

/**
 * Class EOSOptimizer
 * @package App\Libraries
 */
class EOSOptimizer {

    /**
     * @param $args_query
     *
     * @return mixed
     */
    public static function parseMetaQuery(&$args_query){
        $skip = false;
        $test = false;
        $show_query = false;
        if($show_query){
            print_r($args_query['meta_query']);
            exit();
        }
        if(!$skip && !empty($args_query['meta_query'])){
            /**
             * @param \Illuminate\Database\Query\Builder $_query
             * @param \Illuminate\Database\Query\Builder $__query
             */

            global $table_prefix;
            $prefix = str_replace('wp_','',$table_prefix);
            $query = \DB::table($prefix.'postmeta')->distinct()->select(['post_id']);
            $rel = '';
            $ids = [];

            if(!empty($args_query['meta_query']['relation'])){
                $rel = $args_query['meta_query']['relation'];
                unset($args_query['meta_query']['relation']);
            }
            $es_destacado = [];
            foreach($args_query['meta_query'] as $key => &$val){
                if(isset($val['key']) && $val['key'] == 'es_destacado'){
                    $es_destacado = $val;
                    break;
                }
            }
            if(!empty($es_destacado)){
                array_unshift($args_query['meta_query'],$es_destacado);
            }

            foreach($args_query['meta_query'] as $key => &$val){
                if(is_string($key) && $key == 'relation'){
                    $rel = $val;
                    continue;
                }
                $_fn = function($__query) use (&$val){
                    if($val['compare'] == 'BETWEEN') $__query->where('meta_key','=',$val['key'])->whereBetween('meta_value',$val['value']);
                    else $__query->where('meta_key','=',$val['key'])->where('meta_value',$val['compare'],$val['value']);
                };
                if(!empty($val['relation'])){
                    $fn = function($_query) use ( &$val, &$_fn ) {
                        $_rel = '';
                        foreach($val as $_key => &$_val){
                            if(is_string($_key) && $_key == 'relation'){
                                $_rel = $_val;
                                continue;
                            }
                            $_fn = function($__query) use (&$_val){
                                if($_val['compare'] == 'BETWEEN') $__query->where('meta_key','=',$_val['key'])->whereBetween('meta_value',$_val['value']);
                                else $__query->where('meta_key','=',$_val['key'])->where('meta_value',$_val['compare'],$_val['value']);
                            };
                            $_query = $_rel == 'AND' ? $_query->where($_fn) : $_query->orWhere($_fn);
                        }
                    };
                    $query = $rel == 'AND' ? $query->where($fn) : $query->orWhere($fn);
                }
                else $query = $rel == 'AND' ? $query->where($_fn) : $query->orWhere($_fn);
                if(empty($ids) || $rel == 'AND') $ids = $query->get()->pluck(['post_id'])->toArray();
                else {
                    $_ids = $query->get()->pluck(['post_id'])->toArray();
                    $ids = array_unique(array_merge($ids,$_ids));
                }
                $query = \DB::table($prefix.'postmeta')->distinct()->select(['post_id']);
                if($rel == 'AND') $query->whereIn('post_id',$ids);
            }

            if($test){
                $sql = str_replace(array('?'), array('\'%s\''), $query->toSql());
                $sql = vsprintf($sql, $query->getBindings());
                echo $sql;
                exit();
            }
            unset($args_query['meta_query']);
            if(empty($ids)) $ids = [0];
            $args_query['post__in'] = $ids;
            $args_query['ignore_sticky_posts'] = 1;
        }
        return $args_query;
    }
}
