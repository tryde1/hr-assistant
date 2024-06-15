<x-filament-panels::page xmlns:x-filament="http://www.w3.org/1999/html">
    <x-filament-panels::form wire:submit="submit">
        <div class="">
            <div class="grid flex-1 auto-cols-fr gap-y-8">
                <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
                    <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                        <thead class="divide-y divide-gray-200 dark:divide-white/5">
                            <tr class="bg-gray-50 dark:bg-white/5">
                                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name"
                                    style=";">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                    Наименование
                                </span>
                            </span>
                                </th>
                                @foreach($dates as $key => $date)
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                                        <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                            <span
                                                class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                                {{$date->day}}
                                            </span>
                                        </span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                            @foreach($employees as $employeeKey => $employee)
                                <tr class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-name">
                                        <div class="fi-ta-col-wrp">
                                            <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                                <div class="flex ">
                                                    <div class="flex max-w-max" style="">
                                                        <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                                            <span
                                                                class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white"
                                                                style=""
                                                            >
                                                                {{$employee->name}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach($dates as $dateKey => $date)
                                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-salary {{$date->isCurrentDay() ? 'bg-gray-100' : ''}}">
                                            <div class="fi-ta-col-wrp">
                                                <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                                    <div class="flex ">
                                                        <div class="flex max-w-max" style="">
                                                            <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                                                <span class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white">
                                                                    @if(!$date->isCurrentDay())
                                                                        <x-filament::input.checkbox
                                                                            disabled
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
