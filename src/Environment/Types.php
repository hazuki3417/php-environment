<?php
/**
 * @license MIT
 * @author hazuki3417<hazuki3417@gmail.com>
 * @copyright 2021 hazuki3417 all rights reserved.
 */

namespace Selen\Environment;

/**
 * 展開環境に対応した設定値を返すクラス
 */
class Types
{
    /**
     * インスタンスを保持するプロパティ
     *
     * @var array\Selen\Environment\TypeInterface[]
     */
    private $types;

    /**
     * コンストラクター
     *
     * @param TypeInterface ...$types
     *
     * @return \Selen\Environment\Types 新しいTypesインスタンスを返します
     */
    final public function __construct(TypeInterface ...$types)
    {
        $this->types = $types;
    }

    /**
     * 環境名に対応したインスタンスを取得します
     *
     * @param string $name 環境名を渡します
     *
     * @return TypeInterface 環境に対応したインスタンスを返します
     */
    final public function get(string $name): TypeInterface
    {
        // @var \Selen\Environment\TypeInterface
        foreach ($this->types as $type) {
            if ($type->name() !== $name) {
                continue;
            }
            return $type;
        }
        throw new \RuntimeException(
            'The specified environment name does not exist'
        );
    }
}
