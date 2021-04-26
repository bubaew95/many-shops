<?php

define('IMAGE_CROP_WIDTH', 400);
define('IMAGE_CROP_HEIGHT', 400);
define('IMAGE_CROP_KAR', true); //Не сохранять пропорции

define('PERPAGE', 9);

define('UPLOADS', '/uploads');
define('THUMBS', '/uploads/thumbs');
define('RUB', '&nbsp;₽');

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
];
