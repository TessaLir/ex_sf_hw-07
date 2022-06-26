<?php 
    // 11.7. Практика

    // Массив и функция для второго задания.
    $comparisonTableValues = [ true, false, 1, 0, -1, '1', null, 'php' ];

    // По моей логике, функция должна полюбому отдавать строку, по этому задал выходное значение string.
    // Создал отдельную функцию, что бы не дублировать описанный ниже функционал.
    $getStrongLine = function ($value): string {
        $result = '';

        if (gettype($value) === 'string') {                         // Если значение есть строка, то надо добавить ковычки к выводу.
            $result = "\"$value\"";
        } elseif  (gettype($value) === 'boolean') {                 // Если значение есть булев, то надо вывести его ввиде строки, так как true = '1', а false = ''.
            $result = $value ? 'true' : 'false';
        } else {
            $result = $value !== null ? $value : 'null';            // Если значение есть null, то надо вывести его как строку 'null', так как null = ''.
        }                                                           // Остальные значение можно выводить без изменений.

        return '<strong>' . strtoupper($result) . '</strong>';      // По идее добавление тега strong в данном влучае излишнее, но зато меньше повторяющегося ниже.
                                                                    // Конкатенировать strong до return не стал, так как использую strtoupper, 
                                                                    // сам strong приводить в верхний регистр нет желания.
                                                                    // Особенность PHP, метод strtoupper не работает с кирилицей, для кирилицы надо использовть mb_strtoupper
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP-PRO.11.7. Практика</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

    <header>
        <div class="container">
            <h1>11.7. Практика</h1>
        </div>
    </header>

    <div class="main">

        <section>
            <div class="container" style="margin-top:55px;">
                <h3><?= 'Задание 1. Таблица истинности PHP' ?></h3>

                <table class="table table-bordered table-success table-striped">
                    <thead>
                        <tr>
                            <th><strong>A</strong></th>
                            <th><strong>B</strong></th>
                            <th><strong>!A</strong></th>
                            <th><strong>A || B</strong></th>
                            <th><strong>A &amp;&amp; B</strong></th>
                            <th><strong>A xor B</strong></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php // Циклы, пока не проходили, но все же... ?>
                        <?php for ($a = 0; $a < 2; $a++): ?>
                            <?php for ($b = 0; $b < 2; $b++): ?>
                                
                                <tr>
                                    <td><?= ($a) ?></td>
                                    <td><?= ($b) ?></td>
                                    <td><?= !$a ? 'true' : 'false' ?></td>
                                    <td><?= ($a || $b) ? 'true' : 'false' ?></td>
                                    <td><?= ($a && $b) ? 'true' : 'false' ?></td>
                                    <td><?= ($a xor $b) ? 'true' : 'false' ?></td>
                                </tr>

                            <?php endfor; ?>
                        <?php endfor; ?>

                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <div class="container" style="margin-top:55px;">
                <h3><?= 'Задание 2. Таблица сравнения.' ?></h3>

                <div class="row">

                    <div class="col">
                        <h5>Гибкое сравнение в PHP.</h5>

                        <table class="table table-bordered table-success table-striped">
                            <thead>
                                <tr>
                                    <th width="10px"></th>

                                    <?php // Для сокращения строчек кода использую массив, цикл и функцию, для вывода заголовков ?>
                                    <?php // При изучении конструкций написания со скобками и форматом ENDIF, ENDFOR и т.д. кажется более читабельным. ?>

                                    <?php for ($i = 0; $i < count($comparisonTableValues); $i++): ?>
                                        <th width="10px">
                                            <strong><?= $getStrongLine($comparisonTableValues[$i]) ?></strong>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($comparisonTableValues); $i++): ?>
                                    <tr>
                                        <?php 
                                            for ($j = -1; $j < count($comparisonTableValues); $j++) {

                                                // Можно выводить информацию в разных местах, но скорее всего это при расширении проекта будет приводить к проблемам
                                                // читаемости кода. 
                                                // В выводе информации по Жёсткое сравнение в PHP, немного иначе организовал вывод данных.

                                                if ($j === -1) {
                                                    echo '<td>' . $getStrongLine($comparisonTableValues[$i]) . '</td>';
                                                }
                                                else {
                                                    // При конкатинации надо не забывать указывать скобки, иначе будет не верно отрабатываться конкатинации строк
                                                    // Можно запутаться в количестве скобок... это минус
                                                    echo '<td>' . (($comparisonTableValues[$i] == $comparisonTableValues[$j]) ? 'true' : 'false') . '</td>';
                                                }
                                                
                                            }
                                        ?>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="col">
                        <h5>Жёсткое сравнение в PHP.</h5>

                        <table class="table table-bordered table-success table-striped">
                            <thead>
                                <tr>
                                    <th width="10px"></th>
                                    <?php for ($i = 0; $i < count($comparisonTableValues); $i++): ?>
                                        <th width="10px">
                                            <strong><?= $getStrongLine($comparisonTableValues[$i]) ?></strong>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($comparisonTableValues); $i++): ?>
                                    <tr>
                                        <?php 
                                            // задал начало цикла с -1 что бы потом делать меньше арифметических дейстий для получения значений
                                            // из массива $values[$j]; при -1 мы смотрим в этот массив по значению $i внешнего цикла.
                                            for ($j = -1; $j < count($comparisonTableValues); $j++) {

                                                // тут я решил записывать линию в строку, после один раз ее выводить при помощи echo
                                                $printLine = '<td>';

                                                if ($j === -1) {
                                                    $printLine .= $getStrongLine($comparisonTableValues[$i]);
                                                }
                                                else {
                                                    // Тут количество скобок сократилось... что более хорошо.
                                                    $printLine .= $comparisonTableValues[$i] === $comparisonTableValues[$j] ? 'true' : 'false';
                                                }

                                                $printLine .= '</td>';

                                                // при таком подходе проще находить участки кода, где что то выводится.
                                                echo $printLine;
                                            }
                                        ?>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
</html>