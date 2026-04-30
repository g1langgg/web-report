<nav x-init="currentTheme = localStorage.getItem('theme') || 'dark'" x-data="{ 
    open: false, 
    currentTheme: 'dark',
    toggleTheme() { 
        this.currentTheme = this.currentTheme === 'dark' ? 'light' : 'dark'; 
        localStorage.setItem('theme', this.currentTheme); 
        document.documentElement.setAttribute('data-theme', this.currentTheme); 
    } 
}" class="sticky top-0 z-40" style="background: var(--nav-bg); backdrop-filter: blur(24px) saturate(1.3); border-bottom: 1px solid var(--border);">
    <?php
        $unreadCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
        $recentNotifications = \App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get();
    ?>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-8">
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 group">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl shadow-sm transition-all duration-300 group-hover:shadow-lg" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); box-shadow: 0 0 20px var(--accent-glow);">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#050508" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0H5m4 0v-5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color: var(--text-primary);">Hotel Report</p>
                        <p class="text-xs" style="color: var(--text-tertiary);">Dashboard operasional</p>
                    </div>
                </a>

                <div class="hidden items-center gap-1 sm:flex">
                    <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('dashboard'),'active' => request()->routeIs('dashboard'),'class' => 'rounded-full px-4 py-2','style' => 'color: '.e(request()->routeIs('dashboard') ? 'var(--accent)' : 'var(--text-secondary)').'; '.e(request()->routeIs('dashboard') ? 'background: var(--accent-glow);' : '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard')),'class' => 'rounded-full px-4 py-2','style' => 'color: '.e(request()->routeIs('dashboard') ? 'var(--accent)' : 'var(--text-secondary)').'; '.e(request()->routeIs('dashboard') ? 'background: var(--accent-glow);' : '').'']); ?>
                        Dashboard
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('laporan.index'),'active' => request()->routeIs('laporan.*'),'class' => 'rounded-full px-4 py-2','style' => 'color: '.e(request()->routeIs('laporan.*') ? 'var(--accent)' : 'var(--text-secondary)').'; '.e(request()->routeIs('laporan.*') ? 'background: var(--accent-glow);' : '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('laporan.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('laporan.*')),'class' => 'rounded-full px-4 py-2','style' => 'color: '.e(request()->routeIs('laporan.*') ? 'var(--accent)' : 'var(--text-secondary)').'; '.e(request()->routeIs('laporan.*') ? 'background: var(--accent-glow);' : '').'']); ?>
                        Laporan
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                
                <button @click="toggleTheme()" class="flex h-11 w-11 items-center justify-center rounded-2xl transition-all duration-200 hover:border-[var(--border-accent)]" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-secondary);" title="Toggle Theme">
                    <svg x-show="currentTheme === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                    </svg>
                    <svg x-show="currentTheme === 'light'" class="h-5 w-5" x-cloak fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </button>

                
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => 'w-80','contentClasses' => 'overflow-hidden rounded-3xl py-0 shadow-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => 'w-80','contentClasses' => 'overflow-hidden rounded-3xl py-0 shadow-2xl']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <button class="relative flex h-11 w-11 items-center justify-center rounded-2xl transition-all duration-200 hover:border-[var(--border-accent)]" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-secondary);">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 1 18 14.158V11a6.002 6.002 0 0 0-4-5.659V5a2 2 0 1 0-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 1 1-6 0v-1m6 0H9" />
                            </svg>
                            <?php if($unreadCount > 0): ?>
                                <span class="absolute -right-1 -top-1 inline-flex min-h-5 min-w-5 items-center justify-center rounded-full px-1 text-[10px] font-semibold" style="background: var(--accent); color: #050508;">
                                    <?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?>

                                </span>
                            <?php endif; ?>
                        </button>
                     <?php $__env->endSlot(); ?>
                     <?php $__env->slot('content', null, []); ?> 
                        <div style="background: var(--bg-elevated); border: 1px solid var(--border); border-radius: var(--radius-lg);">
                            <div class="px-4 py-4" style="border-bottom: 1px solid var(--border);">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold" style="color: var(--text-primary);">Notifikasi</p>
                                        <p class="mt-1 text-xs" style="color: var(--text-tertiary);">Update terbaru.</p>
                                    </div>
                                    <?php if($unreadCount > 0): ?>
                                        <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold" style="background: var(--accent-glow); color: var(--accent); border: 1px solid var(--accent-border);"><?php echo e($unreadCount); ?> baru</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                <?php $__empty_1 = true; $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <a href="<?php echo e(route('laporan.show', $notification->laporan_id)); ?>" class="block px-4 py-3 transition-all duration-200 hover:!bg-[rgba(46,196,182,0.06)]" style="border-bottom: 1px solid rgba(255,255,255,0.03); <?php echo e(!$notification->is_read ? 'background: rgba(46,196,182,0.03);' : ''); ?>" onclick="markNotificationRead(<?php echo e($notification->id); ?>)">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-medium" style="color: var(--text-primary);"><?php echo e($notification->title); ?></p>
                                                <p class="mt-1 line-clamp-2 text-xs leading-5" style="color: var(--text-secondary);"><?php echo e($notification->message); ?></p>
                                                <p class="mt-2 text-[11px]" style="color: var(--text-tertiary);"><?php echo e($notification->created_at->diffForHumans()); ?></p>
                                            </div>
                                            <?php if(!$notification->is_read): ?>
                                                <span class="mt-1 h-2.5 w-2.5 rounded-full" style="background: var(--accent);"></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="px-4 py-10 text-center">
                                        <p class="text-sm font-medium" style="color: var(--text-secondary);">Belum ada notifikasi</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="px-4 py-3" style="border-top: 1px solid var(--border);">
                                <a href="<?php echo e(route('notifications.index')); ?>" class="text-sm font-medium" style="color: var(--accent);">Lihat semua notifikasi</a>
                            </div>
                        </div>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => 'w-64','contentClasses' => 'overflow-hidden rounded-3xl py-0 shadow-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => 'w-64','contentClasses' => 'overflow-hidden rounded-3xl py-0 shadow-2xl']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <button class="inline-flex items-center gap-3 rounded-2xl px-3 py-2 text-sm font-medium transition-all duration-200" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-secondary);">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-semibold" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                            <span class="max-w-28 truncate" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></span>
                            <svg class="h-4 w-4" style="color: var(--text-tertiary);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0l-4.25-4.51a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                     <?php $__env->endSlot(); ?>
                     <?php $__env->slot('content', null, []); ?> 
                        <div style="background: var(--bg-elevated); border: 1px solid var(--border); border-radius: var(--radius-lg);">
                            <div class="px-4 py-3" style="border-bottom: 1px solid var(--border);">
                                <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></p>
                                <p class="mt-1 truncate text-xs" style="color: var(--text-tertiary);"><?php echo e(Auth::user()->email); ?></p>
                            </div>
                            <div class="py-1">
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2.5 text-sm transition-colors duration-200 hover:!bg-[rgba(46,196,182,0.05)]" style="color: var(--text-secondary);">Profile</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="block w-full px-4 py-2.5 text-left text-sm transition-colors duration-200 hover:!bg-[rgba(239,68,68,0.06)]" style="color: #ef4444;">Log Out</button>
                                </form>
                            </div>
                        </div>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
            </div>

            
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-secondary);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden" style="background: var(--bg-primary); backdrop-filter: blur(24px); border-top: 1px solid var(--border);">
        <div class="space-y-1 px-4 py-4">
            <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('dashboard'),'active' => request()->routeIs('dashboard'),'style' => 'color: var(--text-secondary);']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard')),'style' => 'color: var(--text-secondary);']); ?>Dashboard <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('laporan.index'),'active' => request()->routeIs('laporan.*'),'style' => 'color: var(--text-secondary);']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('laporan.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('laporan.*')),'style' => 'color: var(--text-secondary);']); ?>Laporan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>

        </div>
        <div class="px-4 py-4" style="border-top: 1px solid var(--border);">
            <div class="mb-3">
                <div class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></div>
                <div class="text-xs" style="color: var(--text-tertiary);"><?php echo e(Auth::user()->email); ?></div>
            </div>
            <div class="space-y-1">
                <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('profile.edit'),'style' => 'color: var(--text-secondary);']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit')),'style' => 'color: var(--text-secondary);']); ?>Profile <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','style' => 'color: #ef4444;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','style' => 'color: #ef4444;']); ?>Log Out <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script>
        function markNotificationRead(id) {
            fetch(`/notifications/${id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Content-Type': 'application/json' } });
        }
    </script>
</nav>
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>