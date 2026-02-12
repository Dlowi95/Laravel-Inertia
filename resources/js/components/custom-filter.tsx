import { type IFilter } from "@/types"
import { Form } from "@inertiajs/react"
import user_catalogue from "@/routes/user_catalogue"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

interface ICustomeFilter{
    filters: IFilter[] | undefined
}
const CustomFilter = ({
    filters
}: ICustomeFilter) => {
    return (
        <Form 
            method="get"
            action={user_catalogue.index()}
            options={{
                preserveScroll: true
            }}
        >
            <div className="flex">
                { filters && filters.map(filter =>
                    <Select
                        key={filter.key}
                        onValueChange={() => {}}
                    >
                        <SelectTrigger className={`w-[180px] mr-[10px] cursor-pointer rounded-[5px] ${filter.className ? filter.className : ''}`}>
                            <SelectValue placeholder={filter.placeholder} />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                {filter.options.map(option => <SelectItem key={option.value} value={option.value}>{option.label}</SelectItem>)}
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                )}
            </div>
        </Form>
    )
}
export default CustomFilter