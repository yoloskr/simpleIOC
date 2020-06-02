<?php
/**
 * Created by PhpStorm.
 * User: yolo
 * Date: 2019-10-09
 * Time: 13:50
 */

namespace App\SimpleIOC;

/**
 * 支持反射的容器
 *
 * 1.container->bind('moment',function(){return Moment()});
 * 2.container->bind('moment',new Moment())
 * 3.container->bind('moment,'App\SimpleIOC\Moment')
 * Class Container
 * @package App\SimpleIOC
 */
class ContainerPlus
{
    /**
     * 绑定未解析
     * @var
     */
    protected $binds;



    /**
     * 容器里面到实例
     * @var
     */
    protected $instances;

    public function __construct()
    {
        $this->registerServerProvider();
    }

    /**
     * 相当与Laravel ServiceProvider做的事情
     * 注册服务提供者
     */
    public function registerServerProvider()
    {

        //绑定类
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

        $this->bind('aliyun2',"App\SimpleIOC\Aliyun");

    }

    public function bind($abstract, $concrete)
    {
        if(is_object($concrete) ){
            $this->instances[$abstract] = $concrete;
        }else{
            $this->binds[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        array_unshift($parameters, $this);
        if($this->binds[$abstract] instanceof \Closure){
            return call_user_func_array($this->binds[$abstract], $parameters);
        }


        return $this->build($this->binds[$abstract]);
    }

    public function build($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        //没有构造函数直接返回
        if(!$constructor){
            return $reflectionClass->newInstanceArgs();
        }
        $parameters = $constructor->getParameters();
        //构造函数没有参数
        if(!$parameters)
        {
            return $reflectionClass->newInstanceArgs();
        }
        //解析构造函数依赖
        $dependencies = $this->getDependencies($parameters);


        return $reflectionClass->newInstanceArgs($dependencies);

    }

    //依赖解析
    public  function getDependencies($parameters)
    {

        $dependencies = [];
        foreach($parameters as $parameter) {
            $dependency = $parameter->getClass();
            //todo 考虑没有默认值的情况
            if (is_null($dependency)) {
                if($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                }
            } else {
                //递归解析出依赖类的对象
                $dependencies[] = $this->make($parameter->getClass()->name);
            }
        }
        return $dependencies;
    }
}



