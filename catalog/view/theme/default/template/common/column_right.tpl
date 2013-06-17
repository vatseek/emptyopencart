<div id="column-right">
    <div class="box">
        <div class="box-heading">Контакты</div>
        <div class="box-content">
            <table>
                <tr>
                    <td colspan="2" style="font-weight: bold;">Информационная служба:</td>
                </tr>
                <tr>
                    <td><span class="phone"></span></td>
                    <td>+38 097 63 36 100</td>
                </tr>
                <tr>
                    <td><span class="skype"></span></td>
                    <td>lovlya.poper</td>
                </tr>
                <tr>
                    <td colspan="2" class="contact-header">Консультант по приманкам:</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Максим</td>
                </tr>
                <tr>
                    <td><span class="phone"></span></td>
                    <td>+38 096 44 40 280</td>
                </tr>
                <tr>
                    <td colspan="2" class="contact-header">Консультант по спинингам:</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Роман</td>
                </tr>
                <tr>
                    <td><span class="phone"></span></td>
                    <td>+38 097 88 32 635</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="box-heading special">Корзина</div>
        <div class="box-content">
            <?php echo $cart; ?>
        </div>
    </div>
    <?php foreach ($modules as $module) { ?>
    <?php echo $module; ?>
    <?php } ?>
</div>