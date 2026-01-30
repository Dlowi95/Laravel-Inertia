import { Card, CardHeader, CardTitle, CardContent, CardDescription, CardFooter } from '@/components/ui/card';
import { Loader2 } from 'lucide-react';
interface CustomCardProps{
    loading?: boolean,
    title?: string,
    description?: string,
    height?: string,
    isShowHeader?: boolean,
    isShowFooter?: boolean,
    children: React.ReactNode,
    footerChildren?: React.ReactNode
}
const CustomCard = ({
    loading,
    title,
    description,
    height,
    isShowHeader,
    isShowFooter,
    children,
    footerChildren
}: CustomCardProps) => {
    return (
        <Card className="relative rounded-[5px] overflow-hidden pt-[20px]">
            {isShowHeader && 
                <CardHeader className="border-b">
                    <CardTitle className="uppercase" >{title}</CardTitle>
                    <CardDescription className="pb-[20px]">{description}</CardDescription>
                </CardHeader>
            }
            <CardContent className={` ${height ?? 'h-[48]'}`}>
                {children}
            </CardContent>
            {isShowFooter &&
                <CardFooter className="flex justify-center">
                    {footerChildren}
                </CardFooter>
            }
            {loading && 
                <div className="absolute inset-0 flex items-center justify-center bg-black/70 light:bg-block/40 z-10">
                    <Loader2 className="size-8 animate-spin text-muted-foreground"/>
                </div>
            }
        </Card>
    )
}

export default CustomCard