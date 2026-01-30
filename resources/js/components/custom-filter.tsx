import { type IFilter } from "@/types"
import { Form } from "@inertiajs/react"
import user_catalogue from "@/routes/user_catalogue"

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
            <div className="flex justify-between"></div>
        </Form>
    )
}
export default CustomFilter