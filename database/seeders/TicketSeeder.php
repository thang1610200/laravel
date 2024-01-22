<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ticket::create( [
            'id'=>'9a85784c-a84e-4e25-9fbe-70b98617ac78',
            'name'=>'Space Run',
            'slug'=>'space-run',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1698980395/ocu1fegslncrtrppbzqi.jpg',
            'description'=>'NGHI XUAN HALF MARATHON 2023 - Giải chạy bộ offline được tổ chức tại huyện Nghi Xuân (Hà Tĩnh) – Vùng đất “địa linh nhân kiệt”, nơi có nhiều di sản văn hóa phi vật thể tiêu biểu như Ca trù Cổ Đạm, Trò Kiều Tiên Điền và Xuân Liên, Sắc Bùa Xuân Lam, Chầu Văn Xuân Hồng, các làn điệu dân ca Nghệ Tĩnh…, vùng đất sản sinh ra Đại Thi hào dân tộc Nguyễn Du, Đại doanh điền, nhà thơ Nguyễn Công Trứ…',
            'quantity'=>4,
            'price'=>400000,
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'isBrowse'=>1,
            'created_at'=>'2023-11-02 19:59:56',
            'updated_at'=>'2023-11-02 20:00:11'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a8579dc-27e4-4848-ac1c-81f77848b800',
            'name'=>'Thanh Giong',
            'slug'=>'thanh-giong',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1698980657/dxvwmxknpgll5trq3vav.png',
            'description'=>'NGHI XUÂN BÁT CẢNH” là chủ đề của giải chạy năm nay, nhằm tích cực quảng bá, giới thiệu cảnh quan thiên nhiên tươi đẹp, ẩm thực phong phú của các vùng miền và những giá trị văn hoá truyền thống của địa phương cùng với sự thân thiện, mến khách của Nhân dân trên địa bàn huyện Nghi Xuân tới đông đảo du khách trong nước và quốc tế.',
            'quantity'=>5,
            'price'=>250000,
            'seller_id'=>'9a85794e-79bb-41f6-a33d-782c74c997a4',
            'isBrowse'=>1,
            'created_at'=>'2023-11-02 20:04:17',
            'updated_at'=>'2023-11-13 21:09:49'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a858b99-0796-4a6c-ad10-38fee8a7756c',
            'name'=>'DNA',
            'slug'=>'dna',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1698983633/deqonv8craownqyhosqh.png',
            'description'=>'Chiếc vé đến với đến bản giao hưởng của Dalat Ultra Trail chính là sự tham gia đầy quả cảm và nhiệt thành của bạn, bằng tiếng cười, bằng nhịp thở, bằng bước chân trên mọi cự ly của cuộc đua... tất cả sẽ là giai âm bất tận trong bản giao hưởng của chúng ta, đó là bản giao hưởng của núi đồi, của rừng thông, của con suối, của sương mai, của nắng sớm, và của những người yêu thiên nhiên. ',
            'quantity'=>7,
            'price'=>150000,
            'seller_id'=>'9a85794e-79bb-41f6-a33d-782c74c997a4',
            'isBrowse'=>1,
            'created_at'=>'2023-11-02 20:53:53',
            'updated_at'=>'2023-11-13 21:09:41'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a859e35-1779-4e24-9db5-2aa6cbedc8f2',
            'name'=>'Ha Long',
            'slug'=>'ha-long',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1698986755/bafczbmg5vpkyj6cvr7l.png',
            'description'=>'Năm nay, HopeBox đặc biệt tổ chức 1 sự kiện chạy bộ mang tên Move For Hope Running Day trong khuôn khổ chiến dịch 16 ngày Hành động chấm dứt bạo lực trên cơ sở giới của United Nations (16 Days of Activism Against Gender-Based Violence) nhằm kêu gọi tất cả mọi người tại Việt Nam cùng nhau vận động để chấm dứt Bạo lực trên cơ sở Giới. Bạn có thể trao hi vọng bằng việc gây quỹ để hỗ trợ cho một phụ nữ đã/đang trải qua bạo lực giới và trao quyền giúp chúng tôi có khả năng xây dựng được một cửa hàng để bày bán các sản phẩm của những người phụ nữ tại HopeBox, qua đó tạo thêm nhiều cơ hội để được tham gia vào chương trình học nghề và chữa lành tổn thương kéo dài 6 tháng.',
            'quantity'=>10,
            'price'=>700000,
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'isBrowse'=>1,
            'created_at'=>'2023-11-02 21:45:56',
            'updated_at'=>'2023-11-13 21:09:32'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a8f8124-f94a-42ee-b49a-9ffcfcb26f2a',
            'name'=>'K\'Lang',
            'slug'=>'klang',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1699944036/banner-giai-chay-dem-superman-night-run_ug6n0i.jpg',
            'description'=>'K\'Lang Jungle Summit gửi đi thông điệp thúc đẩy tinh thần đoàn kết và sự hoà nhập, bình đẳng. Là một trong những giải chạy đầu tiên của Việt Nam có sự tham gia của người đồng bào Cơ Tu tại Tây Giang, Quảng Nam, chúng tôi hướng tới mục tiêu kết nối con người với con người và con người với thiên nhiên thông qua hoạt động chạy địa hình xuyên rừng nguyên sinh, đồng thời khuyến khích hoạt động du lịch có trách nhiệm.',
            'quantity'=>8,
            'price'=>700000,
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'isBrowse'=>1,
            'created_at'=>'2023-11-07 19:42:56',
            'updated_at'=>'2023-11-13 21:09:23'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a9be52f-be06-4ddb-aa06-4cbf1e56cedb',
            'name'=>'Move for Hope',
            'slug'=>'move-for-hope',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1699943556/lrj3buzxlo90kdgxycyk.png',
            'description'=>'Năm nay, HopeBox đặc biệt tổ chức 1 sự kiện chạy bộ mang tên Move For Hope Running Day trong khuôn khổ chiến dịch 16 ngày Hành động chấm dứt bạo lực trên cơ sở giới của United Nations (16 Days of Activism Against Gender-Based Violence) nhằm kêu gọi tất cả mọi người tại Việt Nam cùng nhau vận động để chấm dứt Bạo lực trên cơ sở Giới. Bạn có thể trao hi vọng bằng việc gây quỹ để hỗ trợ cho một phụ nữ đã/đang trải qua bạo lực giới và trao quyền giúp chúng tôi có khả năng xây dựng được một cửa hàng để bày bán các sản phẩm của những người phụ nữ tại HopeBox, qua đó tạo thêm nhiều cơ hội để được tham gia vào chương trình học nghề và chữa lành tổn thương kéo dài 6 tháng.',
            'quantity'=>4,
            'price'=>150000,
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'isBrowse'=>1,
            'created_at'=>'2023-11-13 23:32:37',
            'updated_at'=>'2023-11-13 23:33:01'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a9be692-0b91-42b4-b848-86ba3af1ec67',
            'name'=>'Smiles',
            'slug'=>'smiles',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1699943788/xhi7ojq8jyww0q6unuif.jpg',
            'description'=>'Tiếp nối thông điệp “Thể thao thay đổi cuộc đời”, nâng cao nhận thức về dị tật hàm mặt tại Việt Nam và hỗ trợ chi phí cho các chương trình phẫu thuật do Operation Smile tổ chức trong năm 2024, Mạng lưới Quan hệ công chúng Việt Nam (VNPR) đồng hành cùng Operation Smile tự hào mang đến giải chạy Color Run For Smiles 2023. Với cung đường chạy tràn ngập sắc màu và một ngày hội tươi vui và bổ ích dành cho gia đình, trẻ nhỏ và các hội nhóm chạy bộ. Hãy cùng tham gia để hòa mình vào không khí lễ hội và giúp mang lại những nụ cười mới nhé.',
            'quantity'=>7,
            'price'=>120000,
            'seller_id'=>'9a8575c3-e758-41c3-9c13-cf57a062dcee',
            'isBrowse'=>1,
            'created_at'=>'2023-11-13 23:36:29',
            'updated_at'=>'2023-11-13 23:36:39'
            ] );
            
            
                        
            Ticket::create( [
            'id'=>'9a9bee9e-26ff-43f1-8253-05769c4ec234',
            'name'=>'Ultra Trail',
            'slug'=>'ultra-trail',
            'image'=>'https://res.cloudinary.com/dstuqb1iv/image/upload/v1699945138/vfgb8jocbnmtcv7gugml.png',
            'description'=>'Dalat Ultra Trail, ngày hội của các những người yêu thiên nhiên và chạy địa hình đã trở lại với mùa thứ sáu: “Bản giao hưởng cao nguyên”, cho dù bạn là người mới bắt đầu đến với bộ môn chạy bộ địa hình hoặc là một chân chạy nhiều năm kinh nghiệm thì chúng tôi luôn tin rằng bạn chính là một phần của bản giao hưởng cao nguyên lần này. Chúng tôi chào đón bạn.',
            'quantity'=>4,
            'price'=>70000,
            'seller_id'=>'9a940235-7170-4dc2-8e44-0cef4446c2ff',
            'isBrowse'=>1,
            'created_at'=>'2023-11-13 23:58:59',
            'updated_at'=>'2023-11-13 23:59:14'
            ] );
    }
}
