<?php namespace Mptt;

use Exception;

class MpttHelper
{
    /**
     * @param $node
     * @param $target
     * @param $position string first-child|last-child|before|after
     * @param $max
     * @return array
     * @throws Exception
     */
    public function generateMoveSteps($node, $target, $position, $max)
    {
        $forward = $node['lft'] > $target['lft'];
        $size = $node['rgt'] - $node['lft'] + 1;

        switch ($position) {
            case 'first-child':
                if ($forward) {
                    $finalLft = $target['lft'] + 1;
                    $lower = $target['lft'];
                    $upper = $node['lft'];
                } else {
                    $finalLft = $target['lft'] - $size + 1;
                    $lower = $node['lft'];
                    $upper = $target['lft'] + 1;
                }
                break;

            case 'last-child':
                if ($forward) {
                    $finalLft = $target['rgt'];
                    $lower = $target['rgt'] - 1;
                    $upper = $node['lft'];
                } else {
                    $finalLft = $target['rgt'] - $size;
                    $lower = $node['rgt'];
                    $upper = $target['rgt'];
                }
                break;

            case 'before':
                if ($forward) {
                    $finalLft = $target['lft'];
                    $lower = $target['lft'] - 1;
                    $upper = $node['lft'];
                } else {
                    $finalLft = $target['lft'] - $size;
                    $lower = $node['rgt'];
                    $upper = $target['lft'];
                }
                break;

            case 'after':
                if ($forward) {
                    $finalLft = $target['rgt'] + 1;
                    $lower = $target['rgt'];
                    $upper = $node['lft'];
                } else {
                    $finalLft = $target['rgt'] - $size + 1;
                    $lower = $node['rgt'];
                    $upper = $target['rgt'] + 1;
                }
                break;

            default:
                throw new Exception('Invalid position: \'' . $position . '\'');
        }

        $increment = $max - $node['lft'] + 1;
        $decrement = $max - $finalLft + 1;
        $operator = $forward ? '+' : '-';

        $updates = [
            [
                'set' => [['lft', '+', $increment], ['rgt', '+', $increment]],
                'where' => [['lft', '>=', $node['lft']], ['rgt', '<=', $node['rgt']]]
            ],
            [
                'set' => [['lft', $operator, $size]],
                'where' => [['lft', '>', $lower], ['lft', '<', $upper]]
            ],
            [
                'set' => [['rgt', $operator, $size]],
                'where' => [['rgt', '>', $lower], ['rgt', '<', $upper]]
            ],
            [
                'set' => [['lft', '-', $decrement], ['rgt', '-', $decrement]],
                'where' => [['lft', '>', $max]]
            ]
        ];

        return $updates;
    }

    /**
     * @param $table
     * @param $updates
     * @return string
     */
    public function toSql($table, $updates)
    {
        $statements = array_map(function ($update) use ($table) {
            return sprintf('UPDATE %s SET %s WHERE %s;',
                $table,
                implode(', ',
                    array_map(function ($set) {
                        return $set[0] . ' = ' . implode(' ', $set);
                    }, $update['set'])
                ),
                implode(' AND ',
                    array_map(function ($where) {
                        return implode(' ', $where);
                    }, $update['where'])
                )
            ) . PHP_EOL;
        }, $updates);

        return implode($statements);
    }
}
