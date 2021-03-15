<x-jet-action-section>
    <x-slot name="title">
        删除账号
    </x-slot>

    <x-slot name="description">
        永久删除您的帐户。
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            一旦您的帐户被删除，其所有资源和数据将被永久删除。在删除您的帐户之前，请下载您希望保留的任何数据或信息。
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                删除账号
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                删除账号
            </x-slot>

            <x-slot name="content">
                您确定要删除您的帐户吗？一旦您的帐户被删除，其所有资源和数据将被永久删除。请输入密码以确认是否要永久删除您的帐户。

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    取消
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    删除账号
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
