<?= \yii\widgets\Menu::widget([
    'itemOptions' => [
        'class' => 'list-group-item'
    ],
    'options' => [
        'class' => 'list-group',
    ],
    'items' => [
        [
            'label' => 'Основное',
            'url' => ['user/index']
        ],
        [
            'label' => 'Мои резюме',
            'url' => ['user/resume']
        ],
        [
            'label' => 'Мои вакансии',
            'url' => ['user/vacancy']
        ],
        [
            'label' => 'Избранное',
            'url' => ['user/favorites']
        ],
    ],
]);
?>
