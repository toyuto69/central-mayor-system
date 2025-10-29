import './bootstrap';
import { Chart } from 'chart.js/auto';
import { createIcons, Home, Package, DollarSign, BarChart3, Sun, Moon, Download, FileText, LogOut } from 'lucide';

window.Chart = Chart;
window.createIcons = createIcons;
window.Home = Home;
window.Package = Package;
window.DollarSign = DollarSign;
window.BarChart3 = BarChart3;
window.Sun = Sun;
window.Moon = Moon;
window.Download = Download;
window.FileText = FileText;

createIcons({
    icons: { Home, Package, DollarSign, BarChart3, Sun, Moon, Download, FileText, LogOut }
});