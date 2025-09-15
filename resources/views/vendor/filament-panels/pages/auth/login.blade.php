{{-- resources/views/vendor/filament-panels/auth/login.blade.php --}}

<x-filament-panels::page.simple>
    <div class="flex flex-col items-center justify-center space-y-6">
        <!-- Ghana-themed header -->
        <div class="w-full text-center">
            <h1 class="text-3xl font-bold" style="color: #006B3F;">Church Management System</h1>
            <p class="mt-2 text-lg font-semibold" style="color: #FCD116;">
                Admin & Pastor Login
            </p>
        </div>

        <!-- Alert for members -->
        <div class="w-full bg-red-600 text-white rounded-lg p-3 text-sm text-center shadow">
            Members cannot log in here. Please contact your church admin for access.
        </div>
    </div>

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
        scopes: $this->getRenderHookScopes()
    ) }}

    <!-- Login form -->
    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
        scopes: $this->getRenderHookScopes()
    ) }}

    <!-- Footer -->
    <div class="mt-6 flex justify-center space-x-2">
        <div class="h-2 w-8 rounded" style="background-color:#CE1126;"></div> {{-- Red --}}
        <div class="h-2 w-8 rounded" style="background-color:#FCD116;"></div> {{-- Yellow --}}
        <div class="h-2 w-8 rounded" style="background-color:#006B3F;"></div> {{-- Green --}}
        <div class="h-2 w-8 rounded bg-black"></div> {{-- Black --}}
    </div>
</x-filament-panels::page.simple>
