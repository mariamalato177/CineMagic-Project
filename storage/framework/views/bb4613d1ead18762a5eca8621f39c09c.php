
<?php
    $colors = match($type) {
        'primary' => 'text-blue-900
                        bg-blue-200
                        border-blue-500 ',
        'secondary' => 'text-gray-900
                    bg-gray-200
                    border-gray-500 ',
        'success' => 'text-green-800
                        border-green-300
                        bg-green-50',
        'danger' => 'text-red-800
                        border-red-300
                        bg-red-50',
        'warning' => 'text-yellow-800
                        border-yellow-300
                        bg-yellow-50 ',
        'info' => 'text-blue-800
                        bg-blue-50
                        border-blue-300 ',
        'light' => 'text-gray-500
                bg-gray-50
                border-gray-300',
            default => 'text-white
                        bg-gray-800
                        border-gray-950',
    }
?>

<div id="<?php echo e($randomId); ?>"
    <?php echo e($attributes->merge(['class' =>
            'flex items-center p-4 ps-8 mb-2
                text-sm font-medium
                border rounded-lg ' . $colors])); ?>>
    <div>
        <?php if($slot->isEmpty()): ?>
            <?php echo e($message); ?>

        <?php else: ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 p-1.5 rounded-lg
                                inline-flex items-center justify-center h-8 w-8"
            onclick="document.getElementById('<?php echo e($randomId); ?>').style.display = 'none'">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
  </button>
</div>

<?php /**PATH /var/www/html/resources/views/components/alert.blade.php ENDPATH**/ ?>