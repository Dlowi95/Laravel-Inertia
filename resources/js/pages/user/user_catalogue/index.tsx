import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { type PageConfig } from '@/types';
import CustomPageHeading from '@/components/custom-page-heading';
import CustomCard from '@/components/custom-card';
import { PlusCircle } from 'lucide-react';
import { Button } from '@/components/ui/button';
import CustomFilter from '@/components/custom-filter';
import { filter } from '@/constants/filter';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Quản lý nhóm thành viên',
        href: '/'
    },
];
const pageConfig: PageConfig={
    module: 'user_catalogue',
    heading: 'Quản lý nhóm thành viên',
    cardHeading: 'Bảng quản lý danh sách thành viên',
    cardDescription: 'Thông tin thành viên, sử dụng các chức năng để tìm kiếm....',
    filters: [...filter]
}

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={pageConfig.heading} />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl page-wrapper">
                <CustomPageHeading
                    heading={pageConfig.heading}
                    breadcrumbs={breadcrumbs}
                />
                <div className="page-container">
                    <CustomCard
                        isShowHeader={true}
                        title={pageConfig.cardHeading}
                        description={pageConfig.cardDescription}
                    >
                        <div className="flex justify-between items-center mb-[10px]">
                            <CustomFilter
                                filters={pageConfig.filters}
                            />

                            <Link href={`${pageConfig.module}/create`}>
                                <Button className="bg-[#ed5565] shadow rounded-[5px] cursor-pointer hover:bg-[#ed5565]/80">
                                    <PlusCircle/>
                                    Thêm bản ghi mới
                                </Button>
                            </Link>
                        </div>
                    </CustomCard>
                </div>
            </div>
        </AppLayout>
    );
}
