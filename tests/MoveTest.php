<?php

use Mptt\MpttHelper;

class MoveTest extends PHPUnit_Framework_TestCase
{
    private $tests = [
        [
            'node' => ['lft' => 6, 'rgt' => 9],
            'target' => ['lft' => 2, 'rgt' => 5],
            'position' => 'first-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 7, 'rgt' => 8],
                ['id' => 4, 'lft' => 3, 'rgt' => 6],
                ['id' => 5, 'lft' => 4, 'rgt' => 5],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 2, 'rgt' => 5],
            'target' => ['lft' => 6, 'rgt' => 9],
            'position' => 'first-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 3, 'rgt' => 6],
                ['id' => 3, 'lft' => 4, 'rgt' => 5],
                ['id' => 4, 'lft' => 2, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 6, 'rgt' => 9],
            'target' => ['lft' => 2, 'rgt' => 5],
            'position' => 'last-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 5, 'rgt' => 8],
                ['id' => 5, 'lft' => 6, 'rgt' => 7],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 2, 'rgt' => 5],
            'target' => ['lft' => 6, 'rgt' => 9],
            'position' => 'last-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 5, 'rgt' => 8],
                ['id' => 3, 'lft' => 6, 'rgt' => 7],
                ['id' => 4, 'lft' => 2, 'rgt' => 9],
                ['id' => 5, 'lft' => 3, 'rgt' => 4],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 6, 'rgt' => 9],
            'target' => ['lft' => 2, 'rgt' => 5],
            'position' => 'before',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 6, 'rgt' => 9],
                ['id' => 3, 'lft' => 7, 'rgt' => 8],
                ['id' => 4, 'lft' => 2, 'rgt' => 5],
                ['id' => 5, 'lft' => 3, 'rgt' => 4],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 6, 'rgt' => 9],
            'target' => ['lft' => 3, 'rgt' => 4],
            'position' => 'before',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 7, 'rgt' => 8],
                ['id' => 4, 'lft' => 3, 'rgt' => 6],
                ['id' => 5, 'lft' => 4, 'rgt' => 5],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 2, 'rgt' => 5],
            'target' => ['lft' => 7, 'rgt' => 8],
            'position' => 'before',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 3, 'rgt' => 6],
                ['id' => 3, 'lft' => 4, 'rgt' => 5],
                ['id' => 4, 'lft' => 2, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 6, 'rgt' => 9],
            'target' => ['lft' => 3, 'rgt' => 4],
            'position' => 'after',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 5, 'rgt' => 8],
                ['id' => 5, 'lft' => 6, 'rgt' => 7],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 2, 'rgt' => 5],
            'target' => ['lft' => 7, 'rgt' => 8],
            'position' => 'after',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 5, 'rgt' => 8],
                ['id' => 3, 'lft' => 6, 'rgt' => 7],
                ['id' => 4, 'lft' => 2, 'rgt' => 9],
                ['id' => 5, 'lft' => 3, 'rgt' => 4],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 3, 'rgt' => 4],
            'target' => ['lft' => 2, 'rgt' => 5],
            'position' => 'first-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 5],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 6, 'rgt' => 9],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
        [
            'node' => ['lft' => 7, 'rgt' => 8],
            'target' => ['lft' => 2, 'rgt' => 9],
            'position' => 'first-child',
            'before' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 3, 'rgt' => 4],
                ['id' => 4, 'lft' => 5, 'rgt' => 6],
                ['id' => 5, 'lft' => 7, 'rgt' => 8],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ],
            'after' => [
                ['id' => 1, 'lft' => 1, 'rgt' => 12],
                ['id' => 2, 'lft' => 2, 'rgt' => 9],
                ['id' => 3, 'lft' => 5, 'rgt' => 6],
                ['id' => 4, 'lft' => 7, 'rgt' => 8],
                ['id' => 5, 'lft' => 3, 'rgt' => 4],
                ['id' => 6, 'lft' => 10, 'rgt' => 11]
            ]
        ],
    ];

    public function testMove()
    {
        foreach ($this->tests as $test) {
            $this->assertMove($test['node'], $test['target'], $test['position'], $test['before'], $test['after']);
        }
    }

    private function assertMove($node, $target, $position, $before, $after)
    {
        $max = max(array_map(function ($item) {
            return $item['rgt'];
        }, $before));

        $mpttHelper = new MpttHelper;
        $updates = $mpttHelper->generateMoveSteps($node, $target, $position, $max);
        $sql = $mpttHelper->toSql('a', $updates);

        $actual = $this->executeMove($before, $sql);

        $direction = $node['lft'] > $target['lft'] ? 'forward' : 'backward';
        $message = $position . ' ' . $direction;

        $this->assertEquals($after, $actual, $message);
    }

    private function executeMove($initial, $sql)
    {
        $query = <<<SQL
DROP TABLE IF EXISTS "a";
CREATE TABLE IF NOT EXISTS "a" (
  "id" Integer NOT NULL,
  "lft" Integer NOT NULL,
  "rgt" Integer NOT NULL
);
SQL;

        $query .= sprintf('INSERT INTO a (id, lft, rgt) VALUES %s;',
            implode(', ',
                array_map(function ($item) {
                    return '(' . $item['id'] . ', ' . $item['lft'] . ', ' . $item['rgt'] . ')';
                }, $initial)
            ));
        $query .= $sql;

        $db = new PDO('sqlite::memory:');
        $db->exec($query);
        return $db->query('SELECT * FROM a;', PDO::FETCH_ASSOC)->fetchAll();
    }

}
