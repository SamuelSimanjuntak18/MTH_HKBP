SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE winners;
TRUNCATE TABLE coupons;


SET FOREIGN_KEY_CHECKS = 1;


UPDATE coupons
SET
    owner_name = 'Ester Angelica br Siagian',
        buyer_name = CONCAT('Pembeli ', coupon_number),
            buyer_phone = '082222222222',
                paid_amount = 100000,
                    payment_percent = 100,
                        payment_status = 'PAID',
                            input_by = 'Admin Test',
                                sold_at = NOW()
                                WHERE coupon_type = 'SALE'
                                AND payment_status = 'AVAILABLE'
                                ORDER BY coupon_number
                                LIMIT 38;
