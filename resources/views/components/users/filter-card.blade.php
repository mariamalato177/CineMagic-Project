<div {{ $attributes }}>
    <form method="GET" action="{{ $filterAction }}">
        <div class="flex flex-col space-y-2">
            <div class="grow flex flex-col space-y-2">
                <div>
                    <x-field.input name="searchName" label="Name" class="grow"
                        value="{{ $searchName }}"/>
                </div>
            </div>
            <div class="p-1"></div>
            <div class="flex justify-start">
                <div class="flex space-x-3">
                    <div>
                        <x-button element="submit" type="dark" text="Filter"/>
                    </div>
                    <div>
                        <x-button element="a" type="light" text="Cancel" :href="$resetUrl"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
