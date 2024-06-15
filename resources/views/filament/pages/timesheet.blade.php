<x-filament-panels::page>
    <x-filament-panels::form wire:submit="submit">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
            <div class="relative divide-y divide-gray-200 overflow-auto dark:divide-white/10 dark:border-t-white/10" style="max-height: 76vh;">
                <table class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5" style="border-collapse: separate; border-spacing: 0;">
                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                        <tr class="bg-gray-50 dark:bg-white/5">
                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6   bg-gray-50 dark:bg-gray-800 z-10 sticky border-e border-b dark:border-gray-700" style="left: 0; top: 0">
                                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                    <span class=" text-sm font-semibold text-gray-950 dark:text-white">
                                        ФИО
                                    </span>
                                </span>
                            </th>
                            @foreach($dates as $key => $date)
                                <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6   bg-gray-50 dark:bg-gray-800 z-[1] sticky border-b dark:border-gray-700" style="left: 0; top: 0">
                                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-center">
                                        <span class=" text-sm font-semibold text-gray-950 dark:text-white">
                                            {{$date->day}}
                                        </span>
                                    </span>
                                </th>
                            @endforeach
                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6   bg-gray-50 dark:bg-gray-800 z-[1] sticky border-b dark:border-gray-700" style="left: 0; top: 0">
                                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                    <span class=" text-sm font-semibold text-gray-950 dark:text-white">
                                        Премия
                                    </span>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                        @foreach($employees as $employeeKey => $employee)
                            <tr class="[@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                <th class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 bg-gray-50 dark:bg-gray-800 z-[1] sticky border-e border-b dark:border-gray-700" style="left: 0">
                                    <div class="">
                                        <div class="grid w-full gap-y-1 px-3 py-4">
                                            <div class="flex ">
                                                <div class="flex max-w-max" style="">
                                                    <div class="inline-flex items-center gap-1.5  ">
                                                        <span class="text-sm leading-6 text-gray-950 dark:text-white">
                                                            {{$employee->name}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                @foreach($dates as $dateKey => $date)
                                    <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 border-b dark:border-gray-700 {{$date->isCurrentDay() ? 'bg-gray-100 dark:bg-gray-800' : ''}}" style="padding-inline-start: 0">
                                        <div class="">
                                            <div class="grid w-full gap-y-1 px-3 py-4">
                                                <div class="flex ">
                                                    <div class="flex max-w-max" style="">
                                                        <div class="inline-flex items-center gap-1.5">
                                                            <span class="text-sm leading-6 text-gray-950 dark:text-white">
                                                                @if(!$date->isCurrentDay())
                                                                    <x-filament::input.checkbox
                                                                        disabled=""
                                                                        :checked="$employee->timesheets->where('date', $date->format('Y-m-d'))->first()"
                                                                    />
                                                                @else
                                                                    {{$this->form->render()->gatherData()['__livewire']->cachedForms['form']->getComponents()[$employeeKey]}}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                                <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 border-b dark:border-gray-700">
                                    <div class="">
                                        <div class="grid w-full gap-y-1 px-3 py-4">
                                            <div class="flex justify-center">
                                                <div class="flex max-w-max" style="">
                                                    <div class="inline-flex items-center gap-1.5  ">
                                                        <span class="text-sm leading-6 text-gray-950 dark:text-white">
                                                            {{$this->getTableActions()[$employeeKey]}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <x-filament::button
                type="submit"
                size="sm"
            >
                Сохранить
            </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>
