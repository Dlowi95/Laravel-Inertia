import { IFilter, ISelectOptionItem } from "@/types";

export const publish: ISelectOptionItem[] = [
    {
        label: 'Không hoạt động',
        value: '1'
    },
    {
        label: 'Hoạt động',
        value: '2'
    }
]

export const chooseAll: ISelectOptionItem = { label: 'Chọn tất cả', value: '0' }

export const filter: IFilter[] = [
    {
        key: 'perpage',
        placeholder: 'Chọn số bản ghi',
        defaultValue: '20',
        options: ['20', '30', '40', '50', '60', '80', '100'].map(item => ({
            label: `${item} bản ghi`,
            value: item
        }))
    },
    {
        key: 'publish',
        placeholder: 'Chọn trạng thái',
        defaultValue: '0',
        options: [
        { ...chooseAll },
        ...publish
        ]
    }
]