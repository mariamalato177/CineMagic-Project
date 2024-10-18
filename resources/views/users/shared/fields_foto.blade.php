@if ($allowUpload)
<div class="mt-6 space-y-6">
    <x-field.image name="file_photo" label="Photo" width="md" deleteTitle="Delete Photo"
        :deleteAllow="$user->image_url" deleteForm="form_to_delete_photo" :imageUrl="$user->image_url" />
    <x-input-error class="mt-2" :messages="$errors->get('photo_filename')" />
</div>
@endif



