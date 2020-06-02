<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 13:50
 */

namespace App\SimpleIOC;

/**
 * 普通容器
 * 支持
 * 1.container->bind('moment',function(){return Moment()});
 * 2.container->bind('moment',new Moment())
 * Class Container
 * @package App\SimpleIOC
 */
class Container
{
    /**
     * 绑定未解析
     *
     * @var
     */
    protected $binds;


    /**
     * 容器里面到实例
     *
     * @var
     */
    protected $instances;

    public function __construct()
    {
        $this->registerServerProvider();
    }

    /**
     * 注册服务提供者
     */
    public function registerServerProvider()
    {

        //绑定类 相当与Laravel ServiceProvider做的事情
        $this->bind('moment', function($container) {
            $moduleName = $container->make('config')->get('upload.default');
            return new Moment($container->make($moduleName));
        });


        $this->bind('aliyun', function($container) {
            return new Aliyun();
        });

        $this->bind('qiniuyun', function($container) {
            return new Qiniuyun();
        });

        $this->bind('config', function($container) {
            return new Config();
        });

        $this->bind('test',new Config());
    }

    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof \Closure) {
            $this->binds[$abstract]     = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}



