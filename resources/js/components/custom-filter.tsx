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
import { Input } from '@/components/ui/input';
import { Button } from "./ui/button";
import { Search, LoaderCircle } from "lucide-react";

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
            {({ processing }) =>(
                <div className="flex">
                    { filters && filters.map(filter =>
                        <Select
                            key={filter.key}
                            onValueChange={() => {}}
                            value={filter.defaultValue}
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
                    <Input
                        type="text"
                        placeholder="Nhập từ khóa muốn tìm kiếm"
                        className="w-[250px] text-[8px] rounded-[5px] mr-[10px]"
                    />
                    <Button className="rounded-[5px] cursor-pointer bg-[#0088FF] hover:bg-[#0088FF]/80 font-light flex items-center">
                        {processing ? <LoaderCircle className="h-4 w-4 animate-spin"/> : <Search/>}
                        <span>Tìm Kiếm</span>
                    </Button>
                </div>
            )}
        </Form>
    )
}
export default CustomFilter