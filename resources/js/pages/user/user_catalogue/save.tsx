import { useRef } from 'react';
import CustomCard from '@/components/custom-card';
import CustomNotice from '@/components/custom-notice';
import CustomPageHeading from '@/components/custom-page-heading';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type IDateTime, type BreadcrumbItem, type PageConfig } from '@/types';
import { Head, Form } from '@inertiajs/react';
import { Button } from "@/components/ui/button";
import { Textarea } from "@/components/ui/textarea"
import { Input } from '@/components/ui/input';
import InputError from '@/components/input-error';
import { LoaderCircle } from 'lucide-react';
import { Label } from '@/components/ui/label';
// import { useForm } from "react-hook-form"
// import * as z from 'zod'
// import { zodResolver } from '@hookform/resolvers/zod'
import user_catalogue from '@/routes/user_catalogue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Thêm mới nhóm thành viên',
        href: '/'
    },
];
//---------------------------------------------------------------------------------------
const pageConfig: PageConfig={
    heading: 'Quản lý nhóm thành viên'
}
//---------------------------------------------------------------------------------------
export interface UserCatalogue extends IDateTime{
    id: number,
    name: string,
    canonical: string,
    description: string
}
interface UserCatalogueSaveProps{
    record?: UserCatalogue
}
export default function UserCatalogueSave({record}: UserCatalogueSaveProps) {

    const buttonAction = useRef("")
    const isEdit = !!record

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={pageConfig.heading} />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl page-wrapper">
                <CustomPageHeading
                    heading={pageConfig.heading}
                    breadcrumbs={breadcrumbs}
                />
                <div className="page-container">
                    <div className="grid grid-cols-12 gap-4">
                        <div className="col-span-5">
                            <CustomNotice></CustomNotice>
                        </div>
                        <div className="col-span-7">
                            <Form
                                action={
                                    isEdit ? user_catalogue.update(record.id) : user_catalogue.store()
                                }
                                method="post"
                                resetOnSuccess={['name', 'canonical', 'description']}
                                transform={(data) => ({
                                    ...data,
                                    ...(isEdit ? {_method: 'put'} : {}),
                                    save_and_redirect: buttonAction.current
                                })}
                            >
                                {({ processing, errors }) => (
                                    <>
                                        <CustomCard
                                            isShowHeader={true}
                                            title="Thông tin chung"
                                            description="Nhập đầy đủ các thông tin dưới đây"
                                        >
                                            <div className="grid grid-cols-2 gap-4 mb-[20px]">
                                                <div className="col-span-1">
                                                    <Label htmlFor="name" className="mb-[10px]">Tên nhóm thành viên<span className="text-[#f00000] text-[16px]">(*)</span></Label>
                                                    <Input
                                                        id="name"
                                                        type="text"
                                                        name="name"
                                                        autoFocus
                                                        tabIndex={1}
                                                        autoComplete="name"
                                                        placeholder=""
                                                        className="mb-[5px]"
                                                        defaultValue={record?.name}
                                                    />
                                                    <InputError message={errors.name} />
                                                </div>
                                                <div className="col-span-1">
                                                    <Label htmlFor="canonical" className="mb-[10px]">Từ khoá nhóm thành viên<span className="text-[#f00000] text-[16px]">(*)</span></Label>
                                                    <Input
                                                        id="canonical"
                                                        type="text"
                                                        name="canonical"
                                                        autoFocus
                                                        tabIndex={1}
                                                        autoComplete="canonical"
                                                        placeholder=""
                                                        className="mb-[5px]"
                                                        defaultValue={record?.canonical}
                                                    />
                                                    <InputError message={errors.canonical} />
                                                </div>
                                            </div>
                                            <div>
                                                <Label htmlFor="description" className="mb-[10px]">Mô tả ngắn</Label>
                                                <Textarea 
                                                    id="description"
                                                    name="description"
                                                    className="h-[170px]"
                                                    autoFocus
                                                    tabIndex={1}
                                                    autoComplete=""
                                                    placeholder=""
                                                    defaultValue={record?.description}
                                                />
                                            </div>
                                            
                                            <div className="mt-[20px] flex justify-end">
                                                <Button 
                                                    type="submit"
                                                    className="bg-blue-500 rounded-[5px] font-light cursor-pointer mr-5"
                                                    tabIndex={4}
                                                    disabled={processing}
                                                    onClick={() => (buttonAction.current = '')}
                                                >
                                                    {processing && (
                                                        <LoaderCircle className="h-4 w-4 animate-spin"/>
                                                    )}
                                                    Lưu thông tin
                                                </Button>
                                                <Button 
                                                    type="submit"
                                                    className="rounded-[5px] font-light cursor-pointer bg-red-500"
                                                    tabIndex={4}
                                                    disabled={processing}
                                                    onClick={() => (buttonAction.current = 'redirect')}

                                                >
                                                    {processing && (
                                                        <LoaderCircle className="h-4 w-4 animate-spin"/>
                                                    )}
                                                    Lưu và đóng
                                                </Button>
                                            </div>
                                        </CustomCard>
                                    </>
                                )}
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
