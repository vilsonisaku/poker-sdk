<?php

namespace ExHelp\Resource;

class BOPath
{
    const prefix = 'backoffice/';

    const static_images = self::prefix.'static-images/';
    
    const backup_sports = self::prefix.'navbar/';

    const backup_categories = self::backup_sports.'categories/';

    const backup_tournaments = self::backup_sports.'tournaments/';

}
