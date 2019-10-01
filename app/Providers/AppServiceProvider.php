<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Schema;
use App\User;
use App\Post;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        $events->listen(BuildingMenu::class,function(BuildingMenu $event){
            $event->menu->add([
                'text' => 'Search',
                'search' => true,
            ],
            ['header' => 'main_navigation'],
            [
                'text' => 'blog',
                'url'  => 'admin/blog',
                'can'  => 'manage-blog',
            ],
            [
                'text'        => 'Dashboard',
                'icon'        => 'fa fa-tachometer-alt',
                'label_color' => 'success',
                'submenu' => [
                    [
                        'text' => 'Dashboard V1',
                        'url'  => '/admin/home'
                    ],
                    [
                        'text' => 'Dashboard V2',
                        'url'  => '/admin/home1',
                    ]
                ]
            ],
            [
                'text'        => 'Roles',
                'url'         => 'admin/roles',
                'icon'        => 'fa fa-user-tag'
            ],
            [
                'text'        => 'Permissions',
                'url'         => 'admin/permissions',
                'icon'        => 'fa fa-user-lock'
            ],
            [
                'text'        => 'Users',
                'url'         => 'admin/users',
                'icon'        => 'fa fa-users',
                'label'       => User::count(),
                'label_color' => 'success',
            ],
            [
                'text'        => 'Posts',
                'url'         => 'admin/posts',
                'icon'        => 'fa fa-file-alt',
                'label'       => Post::count(),
                'label_color' => 'success',
            ],
            ['header' => 'account_settings'],
            [
                'text' => 'profile',
                'url'  => 'admin/profile',
                'icon' => 'fas fa-fw fa-user',
            ],
            [
                'text' => 'change_password',
                'url'  => 'admin/users/change-password',
                'icon' => 'fas fa-fw fa-lock',
            ],
            [
                'text'    => 'multilevel',
                'icon'    => 'fas fa-fw fa-share',
                'submenu' => [
                    [
                        'text' => 'level_one',
                        'url'  => '#',
                    ],
                    [
                        'text'    => 'level_one',
                        'url'     => '#',
                        'submenu' => [
                            [
                                'text' => 'level_two',
                                'url'  => '#',
                            ],
                            [
                                'text'    => 'level_two',
                                'url'     => '#',
                                'submenu' => [
                                    [
                                        'text' => 'level_three',
                                        'url'  => '#',
                                    ],
                                    [
                                        'text' => 'level_three',
                                        'url'  => '#',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => 'level_one',
                        'url'  => '#',
                    ],
                ],
            ],
            ['header' => 'labels'],
            [
                'text'       => 'important',
                'icon_color' => 'red',
            ],
            [
                'text'       => 'warning',
                'icon_color' => 'yellow',
            ],
            [
                'text'       => 'information',
                'icon_color' => 'aqua',
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
