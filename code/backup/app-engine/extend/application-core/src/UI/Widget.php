<?php

namespace DevEngine\Core\UI;

/**
 * 通用部件
 * Class Composite
 * @package DevEngine\Core\UI
 * @method static \DevEngine\Core\UI\Widget\Alert alert(string $content, string $title = null, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Badge badge($content, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Images images($list, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Descriptions descriptions($data, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Form form($data, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Icon icon($content, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Link link($data, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Lists lists($data, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Menu menu(string $name, string $type = 'default', callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Progress progress($value, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Table table($data, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Text text($content, callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\Row row(callable $callback = NULL)
 * @method static \DevEngine\Core\UI\Widget\StatsCard statsCard(callable $callback = NULL)
 */
class Widget
{

    private static $extend;

    public static function __callStatic($method, $arguments)
    {
        $class = '\\DevEngine\\Core\\UI\\Widget\\' . ucfirst($method);
        if (!class_exists($class)) {
            if (!self::$extend[$method]) {
                throw new \RuntimeException('There is no widget method "' . $method . '"');
            } else {
                $class = self::$extend[$method];
            }
        }
        $object = new $class(...$arguments);
        return $object->next()->getRender();
    }
}
